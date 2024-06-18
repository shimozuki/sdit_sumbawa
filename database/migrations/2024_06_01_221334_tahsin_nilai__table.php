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
        Schema::create('nilai_tahsin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('nisn_siswa');
            $table->foreign('nisn_siswa')->references('nisn')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_tahsin');
            $table->foreign('kode_tahsin')->references('kode_tahsin')->on('tahsin')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nilai');
            $table->string('predikat', 1);
            $table->string('ket')->nullable();
            $table->timestamps();
            $table->primary(['nisn_siswa','kode_tahsin']);
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
