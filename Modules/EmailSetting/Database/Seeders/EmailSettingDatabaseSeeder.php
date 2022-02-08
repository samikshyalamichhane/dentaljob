<?php

namespace Modules\EmailSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\EmailSetting\Entities\EmailSetting;
use Illuminate\Database\Eloquent\Model;

class EmailSettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $formData = [
            'email_desc' => 'Dental Job Portal'
        ];

        EmailSetting::create($formData);

        // $this->call("OthersTableSeeder");
    }
}
