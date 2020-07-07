<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Depo02 extends Migration
{
    public function up()
    {
        Schema::create('depo02', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('depoid')->nullable();
            $table->string('adi')->nullable();
            $table->string('aciklama')->nullable();
            $table->string('tipi')->nullable();
            $table->string('kapasite')->nullable();
            $table->string('sira')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('depo02');
    }
}
