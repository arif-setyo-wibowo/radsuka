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
                'password' => '$2a$12$Pxwcb6FyEYljhgAB36j6rOqjHHNUHEulSUi3/GA45WyJDMg4fxpVK',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
    }
}
