<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
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
            'site_name' => 'Dental Job Portal',
            'logo_left' => 'Wed-04-01-39-547933029.logo.png',
            'logo_right' => 'Wed-04-01-39-1112672351.logo.png'
        ];

        Setting::create($formData);
    }
}
