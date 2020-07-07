<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onay01 extends Model
{
    use SoftDeletes;
	
	protected $table = 'onay01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function siparis_onayi()
	{
		return $this->hasOne('App\Models\Onay02', 'onayid', 'id')->where('model','=','siparis01')->where('id','=','modelid');
    }
}
