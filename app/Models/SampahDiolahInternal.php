<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahDiolahInternal extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->join('jenis_sampahs', 'sampah_diolah_internals.jenis_sampah_id', '=', 'jenis_sampahs.id')
        ->where('jenis_sampahs.name', 'like', '%' . $search . '%')
        ->orWhere('sampah_diolah_internals.keterangan', 'like', '%' . $search . '%'); // Contoh tambahan pencarian berdasarkan kolom keterangan
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'petugas_id');
  }

  public function jenisSampah()
  {
    return $this->belongsTo(JenisSampah::class, 'jenis_sampah_id');
  }

  protected $dates = ['tanggal_diolah'];
}
