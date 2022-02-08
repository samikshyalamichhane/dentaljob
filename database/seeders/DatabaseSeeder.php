<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $this->call(UserTableSeeder::class);

        //$this->call(EmployerTableSeeder::class);
        //$this->call(JobCategorySeeder::class);
        //$this->call(JobTableSeeder::class);

        //$this->call(JobSeekerSeeder::class);
        //$this->call(PastExperienceSeeder::class);
    }
}
