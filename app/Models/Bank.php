<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'tb_bank';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_bank','no_rekening'
    ];
}
