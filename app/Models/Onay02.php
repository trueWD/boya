<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onay02 extends Model
{
    use SoftDeletes;
	
	protected $table = 'onay02';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
