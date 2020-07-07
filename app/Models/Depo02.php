<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depo02 extends Model
{
    use SoftDeletes;
	
	protected $table = 'depo02';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
