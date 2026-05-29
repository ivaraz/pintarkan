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

        $lecturersData = [
            ['name' => 'Dr. Ir. Budi Raharjo, M.T.', 'nidn' => '0412037801'],
            ['name' => 'Prof. Dr. Ahmad Zakaria, M.Kom.', 'nidn' => '0405088203'],
            ['name' => 'Siti Aminah, S.T., M.Cs.', 'nidn' => '0422118501'],
            ['name' => 'Dewi Lestari, S.Kom., M.T.I.', 'nidn' => '0415068902'],
            ['name' => 'Hendra Wijaya, M.Sc.', 'nidn' => '0309077504'],
        ];

        $users = User::role('lecturer')->get();

        foreach ($users as $index => $user) {
            $data = $lecturersData[$index] ?? [
                'name' => $faker->name(),
                'nidn' => $faker->unique()->numerify('10##########'),
            ];

            Lecturer::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'nidn' => $data['nidn'],
            ]);
        }
    }
}
