<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fatura01 extends Model
{
    use SoftDeletes;
	
	protected $table = 'fatura01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


	 public function urunler()
	 {
	 	return $this->hasMany('App\Models\Fatura02', 'fatura01', 'id');
     }
	 public function cari()
	 {
	 	return $this->hasOne('App\Models\Cari01', 'id', 'cari01');
     }
}
