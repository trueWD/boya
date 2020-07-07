<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Params extends Model
{
    use SoftDeletes;
	
	protected $table = 'params';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
