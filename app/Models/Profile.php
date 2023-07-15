<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'rt_id');
    }

    public function rw()
    {
        return $this->belongsTo(RW::class, 'rw_id');
    }
}
