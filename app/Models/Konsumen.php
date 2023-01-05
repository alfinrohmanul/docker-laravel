<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'tb_konsumen';
    protected $primaryKey = 'kode_konsumen';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_konsumen','no_konsumen','nama_konsumen','no_hp','kota','alamat','tgl_join','segmentasi','status_member','status_konsumen'
    ];
}
