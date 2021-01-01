<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use App\Models\Role;
use App\Models\Depo01;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    protected $fillable = ['name', 'email', 'password', 'remember_token'];

    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function depoFirst()
    {
        return $this->hasOne(Depo01::class, 'id', 'depo01')
            ->withDefault(
                ['depoadi' => '']
            );
    }

    // $user->search('deponun ismi')

    // public function scopeSearch($query, $string, $searchMinLength = 3)
    // {
    //     if (strlen($string = trim($string)) >= $searchMinLength) {
    //         return $query
    //             ->where('title', 'LIKE', '%' . $string . '%')
    //             ->orWhere('accountant_code', 'LIKE', '%' . $string . '%')
    //             ->orWhere('tax_number', 'LIKE', '%' . $string . '%');
    //     }
    // 
    //     return $query;
    // }
    
}
