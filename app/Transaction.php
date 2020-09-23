<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = ['id_user', 'id_order', 'kode_transaksi', 'tanggal', 'total_bayar', 'kembalian'];
}
