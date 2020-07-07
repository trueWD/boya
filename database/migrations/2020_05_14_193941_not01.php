<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Not01 extends Migration
{
    public function up()
    {
        Schema::create('not01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model')->nullable();
            $table->string('modelid')->nullable();
            $table->string('tipi')->nullable();
            $table->string('hatirlatma')->nullable();
            $table->string('tarih_hatirlatma')->nullable();
            $table->string('userid')->nullable();
            $table->string('username')->nullable();
            $table->longText('not')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('not01');
    }
}
