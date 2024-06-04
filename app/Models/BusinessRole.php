<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessRole extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    const ADMIN = 'admin';
    const MEMBER = 'member';
    
}
