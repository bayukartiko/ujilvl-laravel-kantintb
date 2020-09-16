<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = "orderdetails";

    protected $fillable = ['id_order', 'id_masakan', 'keterangan', 'status_detail_order'];
}
