<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lecturer;
use App\Models\User;
use Faker\Factory as Faker;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $users = User::role('lecturer')->get();

        foreach ($users as $user) {
            Lecturer::create([
                'user_id' => $user->id,
                'name' => $faker->name(),
                'nidn' => $faker->unique()->numerify('#######'),
            ]);
        }
    }
}
