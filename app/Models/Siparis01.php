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
		return $this->hasOne('App\Models\Cari01', 'id', 'cari01');
    }
	public function user()
	{
		return $this->hasOne('App\User', 'id', 'userid');
    }
    public function siparis02()
    {
        return $this->hasMany('App\Models\Siparis02', 'siparis01', 'id');
    }




}
