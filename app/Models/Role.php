<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function relationToUsers()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'roles_id');
    }
}
