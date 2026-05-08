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

        foreach ($courses as $course) {
            for ($i = 0; $i < 2; $i++) {
                Assignment::create([
                    'course_id' => $course->id,
                    'title' => $faker->sentence(4),
                    'description' => $faker->paragraph(),
                    'due_date' => now()->addDays(rand(3,10)),
                ]);
            }
        }
    }
}
