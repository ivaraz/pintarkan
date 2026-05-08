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
        $submissions = Submission::all();

        foreach ($submissions as $submission) {
            Grade::create([
                'submission_id' => $submission->id,
                'score' => rand(60, 100),
                'note' => 'Good job',
            ]);
        }
    }
}
