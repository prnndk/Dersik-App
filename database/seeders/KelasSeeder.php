<?php

namespace Database\Seeders;

use App\Models\kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kelas::create([
            'kelas' => 'MIPA 1',
            'id_angkatan' => '1',
            'nama' => 'ximaja',
            'instagram' => '@ximaja',
            'jumlah' => 34,
        ]);
    }
}
