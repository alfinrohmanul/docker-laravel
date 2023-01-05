<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    use HasFactory;
    protected $table = 'tb_subkategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','id_kategori','kode_sub','nama_sub'
    ];
}
