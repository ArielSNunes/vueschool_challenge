<?php

namespace Database\Seeders;

use App\Enums\TimezoneEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezones = TimezoneEnum::getValues();

        foreach (range(1, 20) as $idx) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => Hash::make("vueschool_rocks"),
                'time_zone' => $timezones[array_rand($timezones)]
            ]);
        }
    }
}
