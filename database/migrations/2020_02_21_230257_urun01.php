<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Urun01 extends Migration
{
    public function up()
    {
        Schema::create('urun01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barkod')->nullable();
            $table->string('marka')->nullable();
            $table->string('model')->nullable();
            $table->string('urunadi')->nullable();
            $table->string('urunkodu')->nullable();
            $table->string('apikodu')->nullable();
            $table->string('birim')->nullable();
            $table->string('miktar')->nullable();
            $table->string('grubu')->nullable();
            $table->string('fiyat')->nullable();
            $table->string('kdv')->nullable();
            $table->string('satis_fiyat')->nullable();
            $table->string('fiyat_grubu')->nullable();
            $table->string('stok')->nullable();
            $table->string('satilan')->nullable();
            $table->string('max_stok')->nullable();
            $table->string('min_stok')->nullable();

            $table->softDeletes();
            $table->timestamps();

         

        });
    }


    public function down()
    {
        Schema::dropIfExists('urun01');
    }
}
