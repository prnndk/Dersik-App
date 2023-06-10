<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        Angkatan::create([
         'nama' => 'Dersik 22',
         'tahun' => '2022',
         'email' => 'dersik@smasa.id',
         'ig' => '@smasadersik',
        ]);
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        $this->call(IndoRegionVillageSeeder::class);
        $this->call(KelasSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'arya@smasa.id',
            'angkatan_id' => '1',
            'kelas_id' => '1',
            'uuid' => Str::uuid(),
            'tempatlahir' => '3572',
            'dob' => '2004-06-04',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);
    }
}
