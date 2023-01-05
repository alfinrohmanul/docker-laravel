<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'tb_supplier';
    protected $primaryKey = 'kode_supp';
    public $incrementing = false;

    protected $fillable = [
        'kode_supp','no_supp','nama_supp','no_telp','kota','alamat','status'
    ];
}
