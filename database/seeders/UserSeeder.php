<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ADMIN
        User::create([
            'email' => 'admin@unsur.ac.id',
            'password' => Hash::make('123'),
        ])->assignRole('admin');

        // DOSEN USERS
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'email' => 'dosen' . ($i + 1) . '@unsur.ac.id',
                'password' => Hash::make('123'),
            ])->assignRole('lecturer');
        }

        // MAHASISWA USERS
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'email' => 'mhs' . ($i + 1) . '@unsur.ac.id',
                'password' => Hash::make('123'),
            ])->assignRole('student');
        }
    }
}
