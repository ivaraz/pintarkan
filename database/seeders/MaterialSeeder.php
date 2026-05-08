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

        foreach ($courses as $course) {
            for ($i = 0; $i < 3; $i++) {
                Material::create([
                    'course_id' => $course->id,
                    'title' => $faker->sentence(),
                    'content' => $faker->paragraph(),
                    'file' => rand(0,1) ? 'materials/sample.pdf' : null,
                ]);
            }
        }
    }
}
