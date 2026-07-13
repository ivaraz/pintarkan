<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lecturer;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $lecturers = Lecturer::all();

        $coursesData = [
            0 => [ // Lecturer 1
                [
                    'title' => 'Pemrograman Web Lanjut',
                    'description' => 'Mata kuliah ini membahas pengembangan aplikasi web modern menggunakan framework Laravel dan arsitektur RESTful API.',
                    'semester' => 4,
                ],
                [
                    'title' => 'Arsitektur Komputer',
                    'description' => 'Mempelajari struktur dan fungsi komponen-komponen utama komputer modern serta interaksinya.',
                    'semester' => 2,
                ],
            ],
            1 => [ // Lecturer 2
                [
                    'title' => 'Struktur Data dan Algoritma',
                    'description' => 'Pembahasan mengenai struktur data dasar seperti array, linked list, stack, queue, tree, graph, serta algoritma pencarian dan pengurutan.',
                    'semester' => 2,
                ],
                [
                    'title' => 'Kecerdasan Buatan',
                    'description' => 'Pengantar konsep AI, pencarian heuristik, sistem pakar, logika fuzzy, jaringan saraf tiruan, dan machine learning.',
                    'semester' => 6,
                ],
            ],
            2 => [ // Lecturer 3
                [
                    'title' => 'Basis Data Terdistribusi',
                    'description' => 'Desain, implementasi, dan manajemen basis data terdistribusi menggunakan teknik replikasi dan fragmentasi data.',
                    'semester' => 5,
                ],
                [
                    'title' => 'Rekayasa Perangkat Lunak',
                    'description' => 'Konsep siklus hidup pengembangan perangkat lunak (SDLC), analisis kebutuhan, pemodelan sistem menggunakan UML, dan manajemen proyek.',
                    'semester' => 5,
                ],
            ],
            3 => [ // Lecturer 4
                [
                    'title' => 'Interaksi Manusia dan Komputer',
                    'description' => 'Mempelajari desain antarmuka pengguna (UI), prinsip kegunaan (usability), pengujian usability, dan perancangan pengalaman pengguna (UX).',
                    'semester' => 3,
                ],
                [
                    'title' => 'Pemrograman Berorientasi Objek',
                    'description' => 'Konsep dasar OOP menggunakan Java/PHP, termasuk encapsulation, inheritance, polymorphism, dan abstraction.',
                    'semester' => 3,
                ],
            ],
            4 => [ // Lecturer 5
                [
                    'title' => 'Keamanan Informasi',
                    'description' => 'Prinsip dasar keamanan sistem informasi, kriptografi, keamanan jaringan, kontrol akses, dan audit keamanan.',
                    'semester' => 7,
                ],
                [
                    'title' => 'Jaringan Komputer',
                    'description' => 'Konsep arsitektur jaringan komputer, protokol TCP/IP, routing, subnetting, dan administrasi server jaringan.',
                    'semester' => 4,
                ],
            ],
        ];

        foreach ($lecturers as $index => $lecturer) {
            $courses = $coursesData[$index] ?? [
                ['title' => $faker->sentence(3), 'description' => $faker->paragraph(), 'semester' => rand(1, 8)],
                ['title' => $faker->sentence(3), 'description' => $faker->paragraph(), 'semester' => rand(1, 8)],
            ];

            foreach ($courses as $c) {
                Course::create([
                    'lecturer_id' => $lecturer->id,
                    'title' => $c['title'],
                    'description' => $c['description'],
                    'semester' => $c['semester'] ?? rand(1, 8),
                ]);
            }
        }
    }
}
