<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MPemetaanGap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('m_pemetaan_gap', function (Blueprint $table) {
            $table->id('id_pemetaan_gap');
            $table->integer('id_hitung');
            $table->integer('id_data_uji');
            $table->integer('id_sub_kriteria');
            $table->string('nilai_gap');
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
