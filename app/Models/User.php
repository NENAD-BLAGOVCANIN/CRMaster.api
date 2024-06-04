<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use App\Models\Role;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_users');
    }

    public function business()
    {
        return $this->hasOne('App\Models\Business', 'id', 'currently_selected_business_id');
    }

    // protected static function booted()
    // {
    //     static::created(function ($user) {
    //         $business = new Business();
    //         $business->name = $user->name . "'s Business";
    //         $business->save();

    //         $user->currently_selected_business_id = $business->id;
    //         $user->save();
    //         $user->businesses()->attach($business);

    //         $userRole = Role::where('name', 'member')->first();

    //         $user->role_id = $userRole->id;
    //         $user->save();
    //     });
    // }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}