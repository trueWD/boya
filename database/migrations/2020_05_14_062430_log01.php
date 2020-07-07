<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Log01 extends Migration
{
    public function up()
    {
        Schema::create('log01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model')->nullable();
            $table->string('modelid')->nullable();
            $table->string('islem')->nullable();
            $table->string('cinsi')->nullable();
            $table->text('aciklama')->nullable();
            $table->string('userid')->nullable();
            $table->string('username')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('log01');
    }
}
