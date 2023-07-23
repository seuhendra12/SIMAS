<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarPoin extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('kode_transaksi', 'like', '%' . $search . '%');
        });
    }

    protected $dates = ['tanggal_transaksi'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
