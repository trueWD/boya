<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siparis01 extends Migration
{
    public function up()
    {
        Schema::create('siparis01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cari01')->nullable();
            $table->string('depo01')->nullable();
            $table->string('toplam_tutar')->nullable();
            $table->string('toplam_kdv')->nullable();
            $table->string('toplam_iskonto')->nullable();
            $table->string('toplam_kar')->nullable();
            $table->string('odemetipi')->nullable();
            $table->string('banka01')->nullable();
            $table->string('durumu')->nullable();
            $table->string('tarih_vade')->nullable();
            $table->string('tarih_odeme')->nullable();
            $table->string('anlasma')->nullable();
            $table->string('userid')->nullable();
            $table->string('aciklama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('siparis01');
    }
}
