<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahsilat01 extends Model
{
    use SoftDeletes;

    protected $table = 'tahsilat01';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userid');
    }
    public function cari()
    {
        return $this->hasOne('App\Models\Cari01', 'id', 'cari01');
    }
}
