<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun02 extends Model
{
    use SoftDeletes;
	
	protected $table = 'urun02';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


	// public function caricekleri()
	// {
	// 	return $this->hasMany('App\Models\HesapDetay', 'cariid', 'id');
    // }
}
