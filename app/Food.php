<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "foods";

    protected $fillable = ['nama_masakan', 'jenis_masakan', 'harga', 'status_masakan'];
}
