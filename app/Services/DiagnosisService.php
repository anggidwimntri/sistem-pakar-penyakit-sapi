<?php

namespace App\Services;

use App\Models\Penyakit;
use App\Models\BasisPengetahuan;

class DiagnosisService
{
    /**
     * Menghitung Diagnosis berbasis Certainty Factor (CF) & Naïve Bayes (NB)
     * Sesuai dengan Perhitungan Bab IV Naskah Skripsi
     * 
     * @param array $selectedGejalaIds  ID Gejala yang dipilih peternak
     * @param array $userWeights        Bobot CF User (key: gejala_id, value: float 0.0 - 1.0)
     */
    public function diagnose(array $selectedGejalaIds, array $userWeights)
    {
        $penyakits = Penyakit::all();

        // 1. Data Prior Probability berdasarkan Data Historis Kasus Sapi 2025 (Total: 3.964 Kasus)
        // Cocokkan key dengan kode penyakit di database kamu ('KP01', 'KP02', dst.)
        $priorProbability = [
            'KP01' => 1119 / 3964, // Helmintiasis = 0.2823
            'KP02' => 406  / 3964, // BEF          = 0.1024
            'KP03' => 772  / 3964, // Scabies      = 0.1948
            'KP04' => 501  / 3964, // Orf          = 0.1264
            'KP05' => 1092 / 3964, // Pink Eye     = 0.2755
            'KP06' => 74   / 3964, // Ringworm     = 0.0187
        ];

        // Base Likelihood Parameter dasar dari Pakar
        $baseLikelihood = 0.8; 

        $tempData = [];
        $totalScoresUnnormalized = 0;

        // =========================================================================
        // TAHAP 1: PERHITUNGAN EVIDENCES & UNNORMALIZED SCORE NAÏVE BAYES
        // =========================================================================
        foreach ($penyakits as $penyakit) {
            // Ambil aturan pakar untuk penyakit ini berdasarkan gejala yang dipilih user
            $rules = BasisPengetahuan::where('penyakit_id', $penyakit->id)
                ->whereIn('gejala_id', $selectedGejalaIds)
                ->get();

            $cfElements = [];
            $totalEvidenceSum = 0;

            if (!$rules->isEmpty()) {
                foreach ($rules as $rule) {
                    $cfPakar = (float) $rule->cf_pakar;
                    $cfUser = (float) ($userWeights[$rule->gejala_id] ?? 0);

                    // CF Evidence = CF Pakar * CF User
                    $evidence = $cfPakar * $cfUser;

                    if ($evidence > 0) {
                        $cfElements[] = $evidence;
                        $totalEvidenceSum += $evidence; // Akumulasi E untuk eksponen NB
                    }
                }
            }

            // A. PERHITUNGAN CERTAINTY FACTOR (CF COMBINE)
            $cfCombine = 0;
            if (count($cfElements) > 0) {
                $cfCombine = $cfElements[0];
                for ($i = 1; $i < count($cfElements); $i++) {
                    // Rumus Kombinasi CF: CF_old + CF_next * (1 - CF_old)
                    $cfCombine = $cfCombine + ($cfElements[$i] * (1 - $cfCombine));
                }
            }

            // B. PERHITUNGAN NAÏVE BAYES (UNNORMALIZED SCORE)
            // Mengambil kode penyakit (misal: 'KP01') dari model Penyakit
            $kodePenyakit = $penyakit->kode_penyakit ?? $penyakit->kode; 
            $prior = $priorProbability[$kodePenyakit] ?? (1 / count($penyakits));

            // Likelihood Berbobot = (0.8)^TotalEvidence
            $likelihoodBerbobot = pow($baseLikelihood, $totalEvidenceSum);

            // Score Unnormalized = Prior * Likelihood Berbobot
            $scoreUnnormalized = $prior * $likelihoodBerbobot;

            // Total Akumulasi Score untuk penyebut normalisasi
            $totalScoresUnnormalized += $scoreUnnormalized;

            $tempData[] = [
                'penyakit' => $penyakit,
                'cf_combine' => $cfCombine,
                'score_unnormalized' => $scoreUnnormalized,
            ];
        }

        // =========================================================================
        // TAHAP 2: NORMALISASI POSTERIOR NAÏVE BAYES & HASIL AKHIR
        // =========================================================================
        $results = [];
        foreach ($tempData as $data) {
            // Normalisasi Posterior NB = Score / Total Score Unnormalized
            $posteriorNB = ($totalScoresUnnormalized > 0) 
                ? ($data['score_unnormalized'] / $totalScoresUnnormalized) 
                : 0;

            $results[] = [
                'penyakit' => $data['penyakit'],
                'cf_score' => round($data['cf_combine'] * 100, 2), // Persentase CF (ex: 92.10)
                'nb_score' => round($posteriorNB * 100, 2),        // Persentase NB (ex: 22.66)
                'raw_cf'   => $data['cf_combine'],
            ];
        }

        // =========================================================================
        // TAHAP 3: PEMERINGKATAN DIAGNOSIS (DARI PERSENTASE CF TERTINGGI)
        // =========================================================================
        usort($results, function ($a, $b) {
            return $b['raw_cf'] <=> $a['raw_cf'];
        });

        return $results;
    }
}