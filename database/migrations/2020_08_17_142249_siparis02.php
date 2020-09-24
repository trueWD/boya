<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siparis02 extends Migration
{
    public function up()
    {
        Schema::create('siparis02', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siparis01')->nullable();
            $table->string('urun01')->nullable();
            $table->string('birim')->nullable();
            $table->string('miktar')->nullable();
            $table->string('fiyat')->nullable();
            $table->string('iskonto')->nullable();
            $table->string('iskonto_tutar')->nullable();
            $table->string('tutar')->nullable();
            $table->string('kdv')->nullable();
            $table->string('kdv_tutar')->nullable();
            $table->string('kdv_dahil')->nullable();
            $table->string('userid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('siparis02');
    }
}
