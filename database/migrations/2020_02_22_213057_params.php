<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Params extends Migration
{
    public function up()
    {
        Schema::create('params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('database')->nullable();
            $table->string('alan')->nullable();
            $table->string('deger')->nullable();
            $table->string('sira')->nullable();
            $table->string('aciklama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('params');
    }
}
