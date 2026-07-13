<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $studentsData = [
            ['name' => 'Rian Hidayat', 'npm' => '2310631170001', 'semester' => 4],
            ['name' => 'Siti Rahmawati', 'npm' => '2310631170002', 'semester' => 2],
            ['name' => 'Fikri Ardiansyah', 'npm' => '2310631170003', 'semester' => 2],
            ['name' => 'Aditya Pratama', 'npm' => '2310631170004', 'semester' => 6],
            ['name' => 'Dinda Lestari', 'npm' => '2310631170005', 'semester' => 5],
            ['name' => 'Fajar Nugraha', 'npm' => '2310631170006', 'semester' => 5],
            ['name' => 'Amalia Putri', 'npm' => '2310631170007', 'semester' => 3],
            ['name' => 'Rizky Ramadhan', 'npm' => '2310631170008', 'semester' => 3],
            ['name' => 'Fitriani', 'npm' => '2310631170009', 'semester' => 7],
            ['name' => 'Bambang Pamungkas', 'npm' => '2310631170010', 'semester' => 4],
        ];

        $users = User::role('student')->get();

        foreach ($users as $index => $user) {
            $data = $studentsData[$index] ?? [
                'name' => $faker->name(),
                'npm' => $faker->unique()->numerify('231063117####'),
                'semester' => rand(1, 8),
            ];

            Student::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'npm' => $data['npm'],
                'semester' => $data['semester'],
            ]);
        }
    }
}


