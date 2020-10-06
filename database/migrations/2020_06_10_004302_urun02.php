<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Urun02 extends Migration
{
    public function up()
    {
        Schema::create('urun02', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('urun01')->nullable();
            $table->string('depo01')->nullable();
            $table->string('miktar')->nullable();
            $table->softDeletes();
            $table->timestamps();

         

        });
    }


    public function down()
    {
        Schema::dropIfExists('urun02');
    }
}
