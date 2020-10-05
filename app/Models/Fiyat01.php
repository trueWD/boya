<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fiyat01 extends Model
{
    use SoftDeletes;

    protected $table = 'fiyat01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function urun01()
    {
        return $this->hasMany('App\Models\Urun01', 'fiyat_grubu', 'id');
    }
}
