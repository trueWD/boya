<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fatura02 extends Model
{
    use SoftDeletes;
	
	protected $table = 'fatura02';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public function urun()
    {
        return $this->hasOne('App\Models\Urun01', 'id', 'urun01');
    }
}
