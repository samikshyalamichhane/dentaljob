<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Jobseeker\Entities\Past_experience;
use Faker\Factory as Faker;
use Str;


class PastExperienceSeeder extends Seeder
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
            Past_experience::create([
                'jobseeker_id' => $faker->numberBetween(1, 2),
                // 'jobseeker_id' => factory(Modules\Jobseeker\Entities\JobSeeker::class)->create()->id,
                'company_name' => $faker->name,
                'job_title' => $faker->name,
                'start_date' => $faker->date,
                'end_date' => $faker->date,

            ]);
        }
    }
}
