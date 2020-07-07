<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulke extends Model
{
    use SoftDeletes;
	
	protected $table = 'ulke';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
