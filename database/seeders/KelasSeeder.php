<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'kode' => 'XI RPL 1'
        ]);
        Kelas::create([
            'kode' => 'XI RPL 2'
        ]);
        Kelas::create([
            'kode' => 'XI RPL 3'
        ]);
    }
}