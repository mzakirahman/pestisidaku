<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PmSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pm_sub_kriteria', function (Blueprint $table) {
            
            $table->id('id_sub_kriteria');
            $table->integer('id_kriteria');
            $table->string('kode_sub_kriteria');
            $table->string('nama_sub_kriteria');
            $table->string('profil_ideal');
            $table->string('faktor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
