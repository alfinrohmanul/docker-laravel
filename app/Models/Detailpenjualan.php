<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    use HasFactory;

    protected $table = 'tb_d_penjualan';
    protected $primaryKey = 'id';
    // public $incrementing = false;
    
    protected $fillable = [
        'kode_penjualan','id','id_barang','nama_file','jumlah','harga','lebar','panjang','hpp'
    ];
}
