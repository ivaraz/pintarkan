<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Course;
use Faker\Factory as Faker;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('Tidak ada course tersedia.');
            return;
        }

        $assignmentsData = [
            [
                'title' => 'Tugas 1: Analisis dan Perancangan Sistem',
                'description' => "Buatlah dokumen analisis kebutuhan sistem dan perancangan awal (flowchart/diagram alir/UML) berdasarkan topik perkuliahan yang telah dibahas pada pertemuan awal.\n\nKetentuan:\n1. Tuliskan dalam format PDF.\n2. Maksimal ukuran file 5MB.\n3. Cantumkan nama dan NPM pada cover dokumen.",
                'days_offset' => -15, // due 15 days ago
            ],
            [
                'title' => 'Tugas 2: Implementasi Praktikum Mandiri',
                'description' => "Lakukan implementasi praktis mandiri sesuai dengan modul petunjuk praktikum bab kedua.\n\nKetentuan:\n1. Kumpulkan laporan hasil praktikum beserta screenshot jalannya program dalam format PDF.\n2. Tuliskan kendala yang dihadapi saat melakukan praktikum pada kolom catatan jika ada.",
                'days_offset' => -3, // due 3 days ago
            ],
            [
                'title' => 'Tugas 3: Studi Kasus Lanjutan dan Project Akhir',
                'description' => "Selesaikan studi kasus yang diberikan pada modul pertemuan akhir secara berkelompok/mandiri.\n\nKetentuan:\n1. Kumpulkan file presentasi/laporan akhir dalam bentuk PDF.\n2. Cantumkan link repository/code source jika diperlukan dalam laporan.",
                'days_offset' => 14, // due 14 days in the future
            ],
        ];

        foreach ($courses as $course) {
            foreach ($assignmentsData as $data) {
                Assignment::create([
                    'course_id' => $course->id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'due_date' => now()->addDays($data['days_offset']),
                    'max_score' => 100,
                    'file' => rand(0, 1) ? 'assignments/modul_tugas.pdf' : null,
                ]);
            }
        }
    }
}
