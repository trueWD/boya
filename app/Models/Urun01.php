<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun01 extends Model
{
    use SoftDeletes;
	
	protected $table = 'urun01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public function fiyat01()
    {
        return $this->hasOne('App\Models\Fiyat01', 'id', 'fiyat_grubu');
    }
    public function urun02()
    {
        return $this->hasMany('App\Models\Urun02', 'urun01', 'id');
    }
    
}
