<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    const CEO = 'CEO';
    const CLIENT = 'client';
    const USER = 'user';
 
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
