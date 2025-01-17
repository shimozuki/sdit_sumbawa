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
        Schema::create('kelas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('kode_kelas')->index();
            $table->string('nama_kelas', 50);
            $table->unsignedBigInteger('wali_kelas')->nullable();
            $table->timestamps();
            $table->primary('kode_kelas');

            // Foreign key constraint
            $table->foreign('wali_kelas')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};
