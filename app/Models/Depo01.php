<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depo01 extends Model
{
    use SoftDeletes;
	
	protected $table = 'depo01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];



    public function istifler()
    {
        return $this->hasMany('App\Models\Depo02', 'depoid', 'id');
    }
}
