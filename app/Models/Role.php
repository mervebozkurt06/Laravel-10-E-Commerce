<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function scopeManager($query)
    {
        return $query->where('name','=', 'Manager')->whereNull('deleted_at')->first();
    }
    public function scopeUser($query)
    {
        return $query->where('name', 'User')->whereNull('deleted_at')->first();
    }

}
