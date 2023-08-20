<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, LogsActivity;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $fillable = [
    'nik',
    'name',
    'role',
    'is_active',
    'password',
  ];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logOnly(['nik', 'name', 'role', 'is_active', 'password']); // Atur atribut yang ingin dicatat
  }

  // public function getActivitylogOptions(): LogOptions
  // {
  //   $logOptions = new LogOptions();

  //   $logOptions->logName = 'user_activities';
  //   // Atur opsi lainnya sesuai kebutuhan Anda

  //   return $logOptions;
  // }

  // public function someActivity()
  // {
  //   activity('Custom Activity')
  //     ->on($this)
  //     ->withProperties(['key' => 'value'])
  //     ->log('Custom activity log');
  // }

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where('name', 'like', '%' . $search . '%');
    });
  }
  public function profile()
  {
    return $this->hasOne(Profile::class);
  }

  public function transaksi()
  {
    return $this->hasOne(Transaksi::class);
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

  public function scopeAdmin($query)
  {
    return $query->where('role', 'admin');
  }

  public function loginHistory()
	{
		return $this->hasMany(LoginHistory::class)->orderBy('login_time', 'desc');
	}
}
