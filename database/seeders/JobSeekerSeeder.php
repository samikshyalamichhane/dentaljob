<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Jobseeker\Entities\Jobseeker;
use Faker\Factory as Faker;
use Str;

class JobSeekerSeeder extends Seeder
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
            Jobseeker::create([
                'first_name' => $faker->name,
                'email' => $faker->email,
                'mobile' => $faker->numberBetween(1000000000, 50000000000),
                // 'slug' => Str::slug($faker->name),
                'user_id' => 4,
            ]);
        }
    }
}
