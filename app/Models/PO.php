<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    use HasFactory;
    protected $table = 'tb_po';
    protected $primaryKey = 'kode_po';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_po','no_po','tgl_po','id_cabang','id_user','status','urut','keterangan','fob','tgl_kirim'
    ];
}
