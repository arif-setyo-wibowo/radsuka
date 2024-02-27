<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('petugas')->insert(
            [
                ['id' => '1',
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => '$2y$12$kCL/6x3/m219sovBkbKRpOlG5RJmOUVBi5mNuGui2MGcWZT2xncay',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
    }
}
