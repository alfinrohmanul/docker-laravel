<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'tb_loghistory';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','log_name','keterangan','id_user','tgllacak','ip_addres','devices'
    ];
}
