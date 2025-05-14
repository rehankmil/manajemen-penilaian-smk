<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mapel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Mapel::create([
            'kode' => 'UMUM001',
            'nama' => 'Matematika',
        ]);
        
        Mapel::create([
            'kode' => 'UMUM002',
            'nama' => 'Bahasa Indonesia',
        ]);
        
        Mapel::create([
            'kode' => 'UMUM003',
            'nama' => 'Bahasa Inggris',
        ]);
        
        Mapel::create([
            'kode' => 'UMUM004',
            'nama' => 'Pendidikan Kewarganegaraan',
        ]);

        Mapel::create([
            'kode' => 'KOM001',
            'nama' => 'Informatika',
        ]);
        
        Mapel::create([
            'kode' => 'KOM002',
            'nama' => 'Algoritma Pemrograman',
        ]);
        
        Mapel::create([
            'kode' => 'KOM003',
            'nama' => 'Jaringan Komputer',
        ]);
    }
}
