<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{

    public function run()
    {
        $admin_pass = password_hash('password', PASSWORD_DEFAULT);
        $sub_admin_pass = password_hash('password', PASSWORD_DEFAULT);

        $admin_data = [
            'full_name' => 'smith',
            'email'     => 'admin@admin.com',
            'password'  => "$admin_pass",
            'role'      => 'admin',
            'status'    => 'Active',
        ];

        $sub_admin_data = [
            'full_name' => 'sherlock',
            'email'     => 'sub-admin@admin.com',
            'password'  => "$sub_admin_pass",
            'role'      => 'sub-admin',
            'status'    => 'Active',
        ];

        $obj = new UserModel();
        $obj->insert($admin_data, false);
        $obj->insert($sub_admin_data, false);
    }
}
