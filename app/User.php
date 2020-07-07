<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name', 'email', 'password', 'remember_token'];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
}
