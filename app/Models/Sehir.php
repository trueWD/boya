<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sehir extends Model
{
    use SoftDeletes;
	
	protected $table = 'sehir';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
}
