<?php

namespace Database\Seeders;

use App\Models\Toko;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $toko = array(
            array('name' => 'name','user_id'=>2,'nohp'=>'08123456','alamat'=>'Jl.Bendungan Wayhalim Bandarlampung','created_at' => $date,'updated_at' => $date),
        );
        Toko::insert($toko);
    }
}
