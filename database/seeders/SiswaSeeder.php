<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            'nisn' => '1',
            'nama' => 'admin',
            'alamat' => 'Jl. Contoh Alamat',  // Provide an address or set it to null if allowed
            'nama_wali' => 'admin',
            'no_tlpn_wali' => '087861540874',  // Ensure column name matches the migration
        ]);
    }
}
