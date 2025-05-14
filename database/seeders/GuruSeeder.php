<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'nama' => 'Budi Santoso S.Pd', 
            'nip' => '196504121990031002', 
            'email' => 'budi.santoso@smk.ac.id', 
            'no_telp' => '081234567890', 
            'jenis_kelamin' => 'L', 
            'tgl_lahir' => '1965-04-12', 
            'avatar' => 'img/avt/avt4.png', 
            'mapel_id' => '1',
            'user_id' => '2',
        ]);

        Guru::create([
            'nama' => 'Siti Rahayu S.Pd', 
            'nip' => '198107252005012003', 
            'email' => 'siti.rahayu@smk.ac.id', 
            'no_telp' => '081345678901', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1981-07-25', 
            'avatar' => 'img/avt/avt1.png', 
            'mapel_id' => '2',
            'user_id' => '3',
        ]);

        Guru::create([
            'nama' => 'H. Dewi Lestari, S.Pd', 
            'nip' => '199001152010012005', 
            'email' => 'dewi.lestari@smk.ac.id', 
            'no_telp' => '081456789012', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1990-01-15', 
            'avatar' => 'img/avt/avt3.png', 
            'mapel_id' => '3',
            'user_id' => '4',
        ]);
        
        Guru::create([
            'nama' => 'Drs. Ahmad Hidayat S.T', 
            'nip' => '199208172015031001', 
            'email' => 'ahmad.hidayat@smk.ac.id', 
            'no_telp' => '081456789012', 
            'jenis_kelamin' => 'L', 
            'tgl_lahir' => '1992-08-17', 
            'avatar' => 'img/avt/avt2.png', 
            'mapel_id' => '4',
            'user_id' => '5',
        ]);
        
        Guru::create([
            'nama' => 'Rina Fitriani, S.Kom', 
            'nip' => '199503062018011001', 
            'email' => 'rina.fitriani@smk.ac.id', 
            'no_telp' => '081678901234', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1995-03-06', 
            'avatar' => 'img/avt/avt1.png', 
            'mapel_id' => '5',
            'user_id' => '6',
        ]);

        Guru::create([
            'nama' => 'H. Syamsul Arifin, S.Ag', 
            'nip' => '196811221990091009', 
            'email' => 'syamsul.arifin@smk.ac.id', 
            'no_telp' => '081234567898', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1968-11-22', 
            'avatar' => 'img/avt/avt2.png', 
            'mapel_id' => '6',
            'user_id' => '7',
        ]);
        
        Guru::create([
            'nama' => 'Hj. Nurhayati, S.Pd, M.Pd', 
            'nip' => '197609111996071007', 
            'email' => 'nurhayati@smk.ac.id', 
            'no_telp' => '081234567896', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1976-09-11', 
            'avatar' => 'img/avt/avt3.png', 
            'mapel_id' => '7',
            'user_id' => '8',
        ]);
        
        Guru::create([
            'nama' => 'Siti Marlia S.Pd', 
            'nip' => '197203051995012003', 
            'email' => 'siti.marlia@smk.ac.id', 
            'no_telp' => '081234567891', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1972-03-05', 
            'avatar' => 'img/avt/avt3.png', 
            'mapel_id' => '1',
            'user_id' => '9',
        ]);
        
        Guru::create([
            'nama' => 'Andri Gunawan M.Kom', 
            'nip' => '198108101998022004', 
            'email' => 'andri.gunawan@smk.ac.id', 
            'no_telp' => '081234567892', 
            'jenis_kelamin' => 'L', 
            'tgl_lahir' => '1981-08-10', 
            'avatar' => 'img/avt/avt2.png', 
            'mapel_id' => '2',
            'user_id' => '10',
        ]);
        
        Guru::create([
            'nama' => 'Dewi Kartika S.T., M.T', 
            'nip' => '198511221999032005', 
            'email' => 'dewi.kartika@smk.ac.id', 
            'no_telp' => '081234567893', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1985-11-22', 
            'avatar' => 'img/avt/avt3.png', 
            'mapel_id' => '3',
            'user_id' => '11',
        ]);
        
        Guru::create([
            'nama' => 'Ahmad Fauzi S.Pd., M.Pd', 
            'nip' => '197911011996042006', 
            'email' => 'ahmad.fauzi@smk.ac.id', 
            'no_telp' => '081234567894', 
            'jenis_kelamin' => 'L', 
            'tgl_lahir' => '1979-11-01', 
            'avatar' => 'img/avt/avt4.png', 
            'mapel_id' => '4',
            'user_id' => '12',
        ]);
        
        Guru::create([
            'nama' => 'Lilis Nuraini S.Kom', 
            'nip' => '198910151997052007', 
            'email' => 'lilis.nuraini@smk.ac.id', 
            'no_telp' => '081234567895', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1979-11-01', 
            'avatar' => 'img/avt/avt1.png', 
            'mapel_id' => '5',
            'user_id' => '13',
        ]);
        
        Guru::create([
            'nama' => 'Hendra Suhendra M.Si', 
            'nip' => '197706301994062008', 
            'email' => 'hendra.suhendra@smk.ac.id', 
            'no_telp' => '081234567896', 
            'jenis_kelamin' => 'L', 
            'tgl_lahir' => '1979-11-01', 
            'avatar' => 'img/avt/avt2.png', 
            'mapel_id' => '6',
            'user_id' => '14',
        ]);
        
        Guru::create([
            'nama' => 'Ratna Dewi S.Pd', 
            'nip' => '198003101995072009', 
            'email' => 'ratna.dewi@smk.ac.id', 
            'no_telp' => '081234567897', 
            'jenis_kelamin' => 'P', 
            'tgl_lahir' => '1980-03-10', 
            'avatar' => 'img/avt/avt2.png', 
            'mapel_id' => '7',
            'user_id' => '15',
        ]);
    }
}
