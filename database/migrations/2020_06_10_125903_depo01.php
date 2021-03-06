<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Depo01 extends Migration
{
    public function up()
    {
        Schema::create('depo01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('depoadi')->nullable();
            $table->string('aciklama')->nullable();
            $table->string('tipi')->nullable();
            $table->string('sira')->nullable();
            $table->string('userid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depo01');
    }
}
