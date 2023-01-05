<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'tb_akun';
    protected $primaryKey = 'kode_akun';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_akun','no_akun','nama_akun','keterangan','tipe','is_header','status'
    ];
}
