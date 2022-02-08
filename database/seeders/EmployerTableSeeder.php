<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Employer\Entities\Employer;
use Faker\Factory as Faker;
use Str;


class EmployerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $str = Str::new()
        for ($i = 0; $i < 50; $i++) {
            Employer::create([
                'user_id' => 3,
                'employer_name' => $faker->name,
                'mobile_number' => $faker->numberBetween(999999999, 100000000),
                'employer_designation' => $faker->name,
                'address' => $faker->address,
                'employer_email' => $faker->email,
            ]);
        }
    }
}
