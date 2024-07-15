<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Mission;

class MissionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Mission::create([
            'title' => $faker->company,
            'description' => $faker->text,
            'organization' => $faker->company,
            'goal_amount' => $faker->numberBetween(100, 1000),
            'image_url' => 'images/missions.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

