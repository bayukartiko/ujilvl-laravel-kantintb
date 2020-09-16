<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['id_meja', 'tanggal', 'id_user', 'keterangan', 'status_order'];
}
