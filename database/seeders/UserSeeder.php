<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'name' => $faker->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'role' => 'user',
        ]);

        User::create([
            'name' => $faker->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'role' => 'admin',
        ]);
    }
}
