<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'tb_penjualan';
    protected $primaryKey = 'kode_penjualan';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_penjualan','no_penjualan','tgl_penjualan','kode_konsumen','kode_pembayaran','diskon','pajak','pph','total','bank','uang_dibayar','keterangan','uang_kembalian','id_user','tipe_bayar','status_doktran'
    ];

    public function customer()
    {
        return $this->belongsTo(Konsumen::class, 'kode_konsumen', 'kode_konsumen');
    }
}
