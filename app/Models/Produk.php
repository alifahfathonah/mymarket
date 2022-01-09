<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id','store_id','name','satuan','gambar','harga','deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
