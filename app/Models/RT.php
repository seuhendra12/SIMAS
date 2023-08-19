<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RT extends Model
{
    use HasFactory;
    

    protected $table = 'rts';
    protected $fillable = ['name'];

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'rt_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
