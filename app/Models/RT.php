<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $fillable = ['name'];

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'rt_id');
    }

}
