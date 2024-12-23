<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data dummy ke tabel karyawan
        DB::table('karyawan')->insert([
            [
                'nisn' => '1234567890', // NISN
                'nama_lengkap' => 'John Doe', // Nama lengkap
                'jabatan' => 'Manager', // Jabatan
                'no_hp' => '081234567890', // No HP
                'foto' => 'https://example.com/photo1.jpg', // URL foto
                'password' => bcrypt('password123'), // Password terenkripsi
                'remember_token' => \Illuminate\Support\Str::random(10), // Token remember
            ],
            [
                'nisn' => '0987654321',
                'nama_lengkap' => 'Jane Smith',
                'jabatan' => 'Staff',
                'no_hp' => '082345678901',
                'foto' => 'https://example.com/photo2.jpg',
                'password' => bcrypt('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ],
            [
                'nisn' => '1122334455',
                'nama_lengkap' => 'Michael Johnson',
                'jabatan' => 'Supervisor',
                'no_hp' => '083456789012',
                'foto' => 'https://example.com/photo3.jpg',
                'password' => bcrypt('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ],
            [
                'nisn' => '2233445566',
                'nama_lengkap' => 'Emily Davis',
                'jabatan' => 'Manager',
                'no_hp' => '084567890123',
                'foto' => 'https://example.com/photo4.jpg',
                'password' => bcrypt('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        ]);
    }
}
