<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiJualSampah extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['tanggal'];

    public function jenis_sampah(){
        return $this->belongsTo(JenisSampah::class,'jenis_sampah_id');
    }
}
