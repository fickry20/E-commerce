<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'  => 'Administrator',
                'email'  =>  "admin@gmail.com",
                'password'  =>  password_hash("admin", PASSWORD_DEFAULT),
                'address' => 'Jaksel',
                'role'  => 'admin',
                'deleted_at' => null,
            ],
            [
                'username'  => 'fikri',
                'email'  =>  "fikri@gmail.com",
                'password'  =>  password_hash("123456", PASSWORD_DEFAULT),
                'address' => 'Jakarta',
                'role'  => 'customer',
                'deleted_at' => null,
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
