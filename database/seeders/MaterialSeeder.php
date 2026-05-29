<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\Course;
use Faker\Factory as Faker;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $courses = Course::all();

        $materialsData = [
            'Pemrograman Web Lanjut' => [
                [
                    'title' => 'Pengenalan Arsitektur MVC & Framework Laravel',
                    'content' => 'Materi ini membahas konsep Model-View-Controller (MVC) pada Laravel, struktur direktori, instalasi project baru, dan konfigurasi environment file (.env).',
                ],
                [
                    'title' => 'Database Migration, Seeding, dan Eloquent ORM',
                    'content' => 'Mempelajari cara membuat schema database secara terprogram menggunakan migration, mengisi data dummy dengan Seeder/Factory, serta melakukan query database menggunakan Eloquent ORM.',
                ],
                [
                    'title' => 'Controller, Routing, dan Integrasi Blade Templating',
                    'content' => 'Membahas pembuatan Controller untuk mengatur logika bisnis, mendefinisikan route RESTful, dan merancang layout UI dinamis menggunakan Blade templating engine.',
                ],
            ],
            'Arsitektur Komputer' => [
                [
                    'title' => 'Evolusi dan Kinerja Komputer Modern',
                    'content' => 'Mempelajari sejarah arsitektur komputer dari generasi pertama hingga era komputasi modern, serta cara mengukur kinerja sistem komputer.',
                ],
                [
                    'title' => 'Memory Internal, Eksternal, dan Cache Memory',
                    'content' => 'Membahas hirarki memori, perbedaan RAM dan ROM, jenis media penyimpanan eksternal, dan fungsi cache memory dalam meningkatkan kecepatan akses data.',
                ],
                [
                    'title' => 'Struktur Central Processing Unit (CPU) dan Set Instruksi',
                    'content' => 'Penjelasan mendalam mengenai register-register CPU, siklus instruksi (fetch-decode-execute), ALU (Arithmetic Logic Unit), dan format set instruksi.',
                ],
            ],
            'Struktur Data dan Algoritma' => [
                [
                    'title' => 'Pengenalan Array, Linked List, dan Stack',
                    'content' => 'Membahas implementasi struktur data linear dasar: representasi memory array statis, pointer pada single/double linked list, serta prinsip LIFO pada Stack.',
                ],
                [
                    'title' => 'Algoritma Pencarian (Binary Search) & Sorting (Bubble, Quick Sort)',
                    'content' => 'Mempelajari efisiensi algoritma pengurutan data serta teknik pencarian cepat menggunakan metode Binary Search dengan kompleksitas waktu O(log n).',
                ],
                [
                    'title' => 'Representasi Binary Tree dan Algoritma Graph Traversal',
                    'content' => 'Pemahaman tentang hirarki non-linear seperti binary search tree (BST) dan graf, serta implementasi algoritma penelusuran DFS (Depth-First Search) dan BFS.',
                ],
            ],
            'Kecerdasan Buatan' => [
                [
                    'title' => 'Pengantar AI dan Algoritma Pencarian Heuristik',
                    'content' => 'Mengenal konsep dasar kecerdasan buatan, agen cerdas, serta teknik pencarian jalur terbaik menggunakan algoritma A* (A-Star) dan Hill Climbing.',
                ],
                [
                    'title' => 'Sistem Pakar dan Penerapan Logika Fuzzy',
                    'content' => 'Mempelajari arsitektur sistem pakar, mesin inferensi, representasi pengetahuan, dan cara menangani ketidakpastian menggunakan logika fuzzy (derajat keanggotaan).',
                ],
                [
                    'title' => 'Pengenalan Jaringan Saraf Tiruan (JST) dan Deep Learning',
                    'content' => 'Membahas arsitektur saraf biologis manusia yang diadopsi ke komputer: perceptron single-layer, multi-layer dengan backpropagation, dan konsep deep learning.',
                ],
            ],
            'Basis Data Terdistribusi' => [
                [
                    'title' => 'Arsitektur dan Karakteristik DBMS Terdistribusi',
                    'content' => 'Mempelajari perbedaan DBMS terpusat dan terdistribusi, otonomi lokal, transparansi data, dan topologi jaringan yang digunakan.',
                ],
                [
                    'title' => 'Teknik Fragmentasi Data Horisontal dan Vertikal',
                    'content' => 'Membahas strategi membagi tabel database besar menjadi bagian-bagian kecil (fragmen) untuk didistribusikan ke berbagai server guna meningkatkan performa.',
                ],
                [
                    'title' => 'Replikasi Data dan Manajemen Transaksi Terdistribusi',
                    'content' => 'Penjelasan mengenai teknik penyalinan data (replikasi sinkron & asinkron), protokol Two-Phase Commit (2PC), serta penanganan konkurensi data.',
                ],
            ],
            'Rekayasa Perangkat Lunak' => [
                [
                    'title' => 'Metodologi SDLC (Waterfall vs Agile/Scrum)',
                    'content' => 'Menganalisis berbagai model pengembangan perangkat lunak, kelebihan dan kekurangan metode klasik Waterfall dibandingkan pendekatan iteratif Agile Scrum.',
                ],
                [
                    'title' => 'Analisis Kebutuhan Sistem dan Pembuatan DFD/UML',
                    'content' => 'Mempelajari cara mengumpulkan kebutuhan pengguna (user requirements), mendesain aliran data dengan DFD, dan memodelkan sistem berbasis objek menggunakan UML.',
                ],
                [
                    'title' => 'Pengujian Perangkat Lunak (Blackbox vs Whitebox Testing)',
                    'content' => 'Membahas pentingnya penjaminan mutu (Quality Assurance) perangkat lunak dengan metode pengujian fungsionalitas luar (Blackbox) dan kode internal (Whitebox).',
                ],
            ],
            'Interaksi Manusia dan Komputer' => [
                [
                    'title' => 'Prinsip Utama Usability dan Human-Centered Design',
                    'content' => 'Mempelajari 10 Heuristik Usability menurut Jakob Nielsen, faktor manusia dalam desain sistem komputer, dan siklus desain terpusat pada pengguna.',
                ],
                [
                    'title' => 'Perancangan Wireframe dan Prototipe Antarmuka Pengguna (UI)',
                    'content' => 'Panduan praktis merancang sketsa antarmuka pengguna (lo-fi wireframe) hingga membuat prototipe interaktif (hi-fi prototype) menggunakan Figma.',
                ],
                [
                    'title' => 'Evaluasi Usability dan User Experience (UX)',
                    'content' => 'Metode mengevaluasi aplikasi menggunakan teknik Cognitive Walkthrough, Heuristic Evaluation, serta usability testing langsung ke pengguna.',
                ],
            ],
            'Pemrograman Berorientasi Objek' => [
                [
                    'title' => 'Pengenalan Class, Object, dan Method',
                    'content' => 'Mempelajari paradigma pemrograman berorientasi objek: cara mendefinisikan kelas, menginstansiasi objek di memory, dan memanggil method/fungsi.',
                ],
                [
                    'title' => 'Penerapan Encapsulation dan Inheritance pada Java',
                    'content' => 'Membahas penyembunyian data menggunakan access modifier (private, protected, public) serta pewarisan sifat dari parent class ke child class.',
                ],
                [
                    'title' => 'Polymorphism, Abstraction, dan Interface Lanjut',
                    'content' => 'Mengimplementasikan method overloading/overriding, mendesain kelas abstrak untuk cetakan generic, dan membuat interface sebagai kontrak kode.',
                ],
            ],
            'Keamanan Informasi' => [
                [
                    'title' => 'Konsep Triad CIA (Confidentiality, Integrity, Availability)',
                    'content' => 'Fondasi dasar keamanan informasi yang memastikan data hanya diakses pihak berwenang, tidak dimodifikasi secara ilegal, dan selalu siap digunakan.',
                ],
                [
                    'title' => 'Pengenalan Kriptografi Simetris dan Asimetris',
                    'content' => 'Mempelajari teknik enkripsi data menggunakan kunci rahasia yang sama (DES, AES) maupun sepasang kunci publik & privat (RSA, ECC).',
                ],
                [
                    'title' => 'Implementasi Firewall dan Keamanan Jaringan Komputer',
                    'content' => 'Membahas fungsi firewall dalam memfilter paket data, mendeteksi serangan dengan IDS/IPS, serta mengamankan komunikasi data menggunakan VPN.',
                ],
            ],
            'Jaringan Komputer' => [
                [
                    'title' => 'Konsep OSI Model dan Protokol TCP/IP',
                    'content' => 'Mempelajari standardisasi 7 layer OSI model serta perbandingannya dengan 4 layer protokol TCP/IP dalam mentransmisikan data di internet.',
                ],
                [
                    'title' => 'Pengalamatan IP (IPv4 Subnetting & CIDR)',
                    'content' => 'Latihan menghitung subnetting jaringan menggunakan CIDR, menentukan IP network, range host IP, dan broadcast address pada topologi lokal.',
                ],
                [
                    'title' => 'Konfigurasi Routing Dinamis dan Static Routing',
                    'content' => 'Mempraktikkan cara meneruskan paket data antar jaringan yang berbeda segment menggunakan protokol routing statis dan dinamis (RIP, OSPF).',
                ],
            ],
        ];

        foreach ($courses as $course) {
            $courseMaterials = $materialsData[$course->title] ?? [];
            
            // Fallback in case course title doesn't match
            if (empty($courseMaterials)) {
                for ($i = 0; $i < 3; $i++) {
                    Material::create([
                        'course_id' => $course->id,
                        'title' => 'Materi ' . ($i + 1) . ' - ' . $faker->sentence(),
                        'content' => $faker->paragraph(),
                        'file' => rand(0, 1) ? 'materials/sample.pdf' : null,
                    ]);
                }
                continue;
            }

            foreach ($courseMaterials as $materialInfo) {
                Material::create([
                    'course_id' => $course->id,
                    'title' => $materialInfo['title'],
                    'content' => $materialInfo['content'],
                    'file' => rand(0, 1) ? 'materials/sample.pdf' : null,
                ]);
            }
        }
    }
}
