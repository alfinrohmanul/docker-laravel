<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPO extends Model
{
    use HasFactory;
    protected $table = 'tb_d_po';
    protected $primaryKey = 'kode_po';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_po','kode_barang','id','no_barang','nama_barang','qty_pesan','satuan','harga'
    ];
}
