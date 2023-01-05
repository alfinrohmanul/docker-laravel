<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'master_karyawans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','nik','nama_lengkap','nama_panggilan','email'
    ];
}
