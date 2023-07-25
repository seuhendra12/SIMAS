<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where('name', 'like', '%' . $search . '%');
    });
  }

  public function kategoriSampah()
  {
    return $this->belongsTo(KategoriSampah::class, 'kategori_sampah_id');
  }

  public function sampahDimanfaatkan()
  {
    return $this->hasMany(SampahDimanfaatkan::class);
  }

  public function sampahDiolahInternal()
  {
    return $this->hasMany(SampahDiolahInternal::class);
  }

  public function sampahDiolahEksternal()
  {
    return $this->hasMany(SampahDiolahEksternal::class);
  }
}
