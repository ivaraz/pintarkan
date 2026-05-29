<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Submission;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $submissions = Submission::with('assignment')->get();

        $feedbackNotes = [
            'Sangat baik, pengerjaan lengkap dan rapi.',
            'Bagus sekali, analisis yang diberikan sangat mendalam dan detail.',
            'Cukup baik, pertahankan terus performa belajarnya.',
            'Secara umum sudah baik, namun ada sedikit kesalahan minor pada bagian akhir.',
            'Kerja bagus! Pemahaman materi sudah sangat matang.',
            'Implementasi kodenya rapi dan dokumentasinya lengkap.',
            'Laporan sangat detail dan terstruktur dengan baik.',
            'Hasil pengujian lengkap dan sesuai dengan kriteria penilaian.',
        ];

        foreach ($submissions as $submission) {
            $isPast = \Carbon\Carbon::parse($submission->assignment->due_date)->isPast();

            // Grade 85% of past submissions, and only 10% of future/early submissions
            $gradeChance = $isPast ? 85 : 10;

            if (rand(1, 100) <= $gradeChance) {
                Grade::create([
                    'submission_id' => $submission->id,
                    'score' => rand(70, 98),
                    'note' => $feedbackNotes[array_rand($feedbackNotes)],
                ]);

                // Update submission status to graded
                $submission->update(['status' => 'graded']);
            }
        }
    }
}
