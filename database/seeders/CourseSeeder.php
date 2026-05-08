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

        foreach ($lecturers as $lecturer) {
            for ($i = 0; $i < 2; $i++) {
                Course::create([
                    'lecturer_id' => $lecturer->id,
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph()
                ]);
            }
        }
    }
}
