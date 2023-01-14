<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use Faker\Factory;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        $barang = Barang::create([
            'nama_barang' => 'PS3',
            'deskripsi_barang' => 'HDD 500, 2 stik',
            'gambar_barang' => 'barang/' .$faker->image('public/storage/barang', 640, 480, 'animals', false)
        ]);


        $barang = Barang::create([
            'nama_barang' => 'PS4',
            'deskripsi_barang' => 'HDD 500, 2 stik',
            'gambar_barang' => 'barang/' .$faker->image('public/storage/barang', 640, 480, 'animals', false)
        ]);

    }
}
