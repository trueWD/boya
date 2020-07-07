<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis01 extends Model
{
    use SoftDeletes;
	
	protected $table = 'siparis01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


	public function cari()
	{
		return $this->hasOne('App\Models\Cari01', 'id', 'cariid');
    }
}
