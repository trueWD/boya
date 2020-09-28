<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banka01 extends Migration
{
    public function up()
    {
        Schema::create('banka01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bakiye')->nullable();
            $table->string('adi')->nullable();
            $table->string('sube')->nullable();
            $table->string('iban')->nullable();
            $table->string('hesap')->nullable();
            $table->string('subekodu')->nullable();
            $table->string('userid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('banka01');
    }
}
