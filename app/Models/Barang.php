<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'tb_barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_barang','no_barang','nama_barang','kategori','satuan','satuan1','harga','is_ukuran','hpp_barang','is_aktif','is_jual','grp','kode_akun1','kode_akun2','barcode','harga1','harga2','itemfor','marginset','subkategori'
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'kode_akun1', 'kode_akun');
    }
}
