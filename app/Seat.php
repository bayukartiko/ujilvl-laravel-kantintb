<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use SoftDeletes;

    protected $table = "seats";

    protected $fillable = ['no_meja'];
    protected $dates = ['deleted_at'];
}
