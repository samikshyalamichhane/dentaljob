<?php

namespace Modules\Job\Database\Seeders;

use Modules\Job\Entities\Job;
use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder
{
    //JobDatabaseSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::factory()->count(100)->create();
        
    }
}