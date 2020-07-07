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
            $table->string('durumu')->nullable();
            $table->string('siparis01')->nullable();
            $table->string('siparis02')->nullable();
            
            $table->string('urunid')->nullable();
            $table->string('urunadi')->nullable();
            $table->string('urunadi_en')->nullable();

            $table->string('uretim_grubu')->nullable();
            $table->string('grubu')->nullable();
            $table->string('kalite')->nullable();
            $table->string('tolerans')->nullable();
            $table->string('boy')->nullable();
            $table->string('miktar')->nullable();



            $table->string('ebata')->nullable();
            $table->string('ebatb')->nullable();
            $table->string('ebatc')->nullable();
            $table->string('ebatkg')->nullable();
            $table->string('hacim')->nullable();
            $table->string('cubuksayisi')->nullable();

            $table->string('derpo')->nullable();
            $table->string('istif')->nullable();
            $table->string('sayimid')->nullable();
            $table->string('sevkid')->nullable();


            $table->string('tarih_sevk')->nullable();
            $table->string('tarih_uretim')->nullable();
            $table->string('tarih_sayim')->nullable();




            $table->softDeletes();
            $table->timestamps();

         

        });
    }


    public function down()
    {
        Schema::dropIfExists('urun02');
    }
}
