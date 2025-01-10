<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'size_name'  => 'All Size',
                'deleted_at' => null,
            ],
        ];
        $this->db->table('sizes')->insertBatch($data);
    }
}
