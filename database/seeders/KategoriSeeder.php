<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $kategori = array(
            array('name' => 'sepatu','created_at' => $date,'updated_at' => $date),
            array('name' => 'baju','created_at' => $date,'updated_at' => $date),
        );
        Kategori::insert($kategori);
    }
}
