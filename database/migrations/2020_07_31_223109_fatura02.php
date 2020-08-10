<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fatura02 extends Migration
{
    public function up()
    {
        Schema::create('fatura02', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fatura01')->nullable();     
            $table->string('urun01')->nullable();     
            $table->string('miktar')->nullable();
            $table->string('fiyat')->nullable();
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
        Schema::dropIfExists('fatura02');
    }
}
