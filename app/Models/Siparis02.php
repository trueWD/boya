<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis02 extends Model
{
    use SoftDeletes;
	
	protected $table = 'siparis02';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public function urunbilgisi()
    {
        return $this->hasOne('App\Models\Urun01', 'id', 'urun01');  
    }
}
