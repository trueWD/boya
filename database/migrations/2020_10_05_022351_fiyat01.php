<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fiyat01 extends Migration
{
    public function up()
    {
        Schema::create('fiyat01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adi')->nullable();
            $table->string('oran')->nullable();
            $table->string('indirim_oran')->nullable();
            $table->string('aciklama')->nullable();
            $table->string('userid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('fiyat01');
    }
}
