<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "foods";

    protected $fillable = ['nama_masakan', 'jenis_masakan', 'gambar', 'harga', 'stok', 'keterangan', 'status_masakan'];
}
