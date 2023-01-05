<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'tb_d_penerimaan';
    protected $primaryKey = 'kode_penerimaan';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_penerimaan','kode_barang','nama_barang','satuan1','satuan2','qty','qty2','harga','total'
    ];
}
