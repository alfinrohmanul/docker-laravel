<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;
    protected $table = 'tb_keuangan';
    protected $primaryKey = 'kode_dokumen';
    public $incrementing = false;

    protected $fillable = [
        'kode_dokumen','no_dokumen','tgl_dokumen','tgl_cair','kode_customer','no_reff','kode_akun_debet','kode_akun_kredit','cara_bayar','catatan','kepada','status_dok','userid','urut','jumlah_rp'
    ];

    public function customer()
    {
        return $this->belongsTo(Konsumen::class, 'kode_customer', 'kode_konsumen');
    }
}
