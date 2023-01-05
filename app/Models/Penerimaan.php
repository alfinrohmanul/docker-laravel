<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'tb_penerimaan_barang';
    protected $primaryKey = 'kode_penerimaan';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_penerimaan','no_faktur','no_sj','tgl_masuk','tgl_sj','kode_supplier','nominal','status_dokumen','id_user','urut','termin','carabayar','id_cabang'
    ];
}
