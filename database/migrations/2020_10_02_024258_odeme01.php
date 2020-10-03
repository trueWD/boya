<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Odeme01 extends Migration
{
    public function up()
    {
        Schema::create('odeme01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cari01')->nullable();
            $table->string('tutar')->nullable();
            $table->string('odemetipi')->nullable();
            $table->string('dekontno')->nullable();
            $table->string('banka')->nullable();
            $table->string('aciklama')->nullable();
            $table->string('userid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('odeme01');
    }
}
