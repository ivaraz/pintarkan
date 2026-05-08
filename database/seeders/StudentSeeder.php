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

        $users = User::role('student')->get();

        foreach ($users as $user) {
            Student::create([
                'user_id' => $user->id,
                'name' => $faker->name(),
                'npm' => $faker->unique()->numerify('23######'),
            ]);
        }
    }
}


