<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'tb_d_pembayaran';
    protected $primaryKey = 'kode_dokumen';

    protected $fillable = [
        'kode_dokumen','id_dokumen','kode_doktransaksi','bayar_rp'
    ];
}
