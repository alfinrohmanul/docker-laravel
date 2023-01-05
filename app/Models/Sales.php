<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'tb_sales';
    protected $primaryKey = 'kode_sales';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_sales','no_sales','nama_sales','no_hp','kota','alamat'
    ];
}
