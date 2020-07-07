<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cari01 extends Migration
{
    public function up()
    {
        Schema::create('cari01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('durumu')->nullable();
            // Ticari
            $table->string('grubu')->nullable();
            $table->string('cariadi')->nullable();
            $table->string('vergino')->nullable();
            $table->string('vergidairesi')->nullable();
            $table->string('muhasebeapi')->nullable();
            // İtetişim
            $table->string('ulke')->nullable();
            $table->string('sehir')->nullable();
            $table->string('ilce')->nullable();
            $table->string('adres')->nullable();
            $table->string('telefon')->nullable();
            $table->string('telefon2')->nullable();
            $table->string('faks')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('yetkili')->nullable();
            $table->string('yetkili_gsm')->nullable();
            $table->string('temsilci')->nullable();
            // Finans
            $table->string('bakiye')->nullable();
            $table->string('parabirimi')->nullable();
            $table->string('vadegun')->nullable();
            $table->string('riskgrubu')->nullable();
            $table->string('aciklama')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('cari01');
    }
}
