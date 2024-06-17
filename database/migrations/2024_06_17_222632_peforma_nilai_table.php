<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_peforma', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_peforma');
            $table->foreign('kode_peforma')->references('kode_peforma')->on('peforma')->onDelete('cascade')->onUpdate('cascade');
            $table->string('predikat', 1);
            $table->timestamps();
            $table->primary(['nisn_siswa', 'kode_peforma']);
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
};
