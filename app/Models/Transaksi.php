<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('kode_transaksi', 'like', '%' . $search . '%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $dates = ['tanggal_transaksi'];

    public function items()
    {
        return $this->hasOne(ItemTransaksi::class);
    }

    public function tukarPoin()
    {
        return $this->hasMany(TukarPoin::class);
    }
}
