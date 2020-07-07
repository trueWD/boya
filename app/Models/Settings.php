<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;
	
	protected $table = 'settings';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


	// public function caricekleri()
	// {
	// 	return $this->hasMany('App\Models\HesapDetay', 'cariid', 'id');
    // }
    

}
