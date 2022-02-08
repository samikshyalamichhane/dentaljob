<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Jobcategory\Entities\Jobcategory;
use Faker\Factory as Faker;
use Str;

class JobCategorySeeder extends Seeder
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
        for ($i=0; $i < 50; $i++) {
            Jobcategory::create([
                'title' => $faker->name,
                'slug'=> Str::slug($faker->name),
                'description' => $faker->text
            ]);
        }
    }
}
