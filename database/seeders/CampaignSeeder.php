<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Campaign::create([
            'user_id' => 1,
            'title' => $faker->company,
            'description' => $faker->text,
            'goal_amount' => $faker->numberBetween(100, 1000),
            'image_url' => 'images/fundraiser.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

