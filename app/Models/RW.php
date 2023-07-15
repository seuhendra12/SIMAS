<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;
    protected $table = 'rws';
    protected $fillable = ['name'];

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'rw_id');
    }
}
