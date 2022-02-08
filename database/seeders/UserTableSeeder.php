<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'info@user.com',
            'password' => bcrypt('secret'),
            'publish' => 1,
            'role' => 'super-admin',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'info@admin.com',
            'password' => bcrypt('secret'),
            'publish' => 1,
            'role' => 'admin',
            'access_level' => 'blog',
        ]);

        // User::create([
        //     'name' => 'Employer',
        //     'email' => 'info@employer.com',
        //     'password' => bcrypt('admin123'),
        //     'publish' => 1,
        //     'is_active' => 1,
        //     'role' => 'employer',
        // ]);

        // User::create([
        //     'name' => 'JobSeeker',
        //     'email' => 'info@jobseek.com',
        //     'password' => bcrypt('admin123'),
        //     'publish' => 1,
        //     'is_active' => 1,
        //     'verified' => 1,
        //     'role' => 'jobseeker',
        //     'username' => 'jobseeker123'
        // ]);
    }
}
