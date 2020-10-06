<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fatura01 extends Migration
{
    public function up()
    {
        Schema::create('fatura01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipi')->nullable();
            $table->string('durumu')->nullable();
            $table->string('fatura_tarihi')->nullable();
            $table->string('cari01')->nullable();
            $table->string('depo01')->nullable();
            $table->string('cariadi')->nullable();
            $table->string('faturano')->nullable();
            $table->string('parabirimi')->nullable();
            $table->string('tutar')->nullable();
            $table->string('odenen')->nullable();
            $table->string('userid')->nullable();
            $table->string('username')->nullable();
            $table->softDeletes();
            $table->timestamps();      

        });
    }


    public function down()
    {
        Schema::dropIfExists('fatura01');
    }
}
