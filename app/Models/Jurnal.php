<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'tb_d_jurnal';
    protected $primaryKey = 'kode_dokumen';

    protected $fillable = [
        'kode_dokumen','tgl_dokumen','kode_akun','catatan','debet_rp','kredit_rp','id_user'
    ];
}
