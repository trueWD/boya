<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settings extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maintenance')->nullable();
            $table->string('maintenance_description')->nullable();
            $table->string('version')->nullable();
            $table->string('siparis_onay')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
