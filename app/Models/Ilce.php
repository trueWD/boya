<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ilce extends Model
{
    use SoftDeletes;
	
	protected $table = 'ilce';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
