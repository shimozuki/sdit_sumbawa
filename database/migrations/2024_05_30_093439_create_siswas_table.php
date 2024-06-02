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
        Schema::create('siswa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('nisn', 10)->primary(); // Define the primary key directly
            $table->string('nama', 50);
            $table->string('alamat', 50)->nullable();
            $table->string('nama_wali', 50);
            $table->string('no_tlpn_wali', 15);
            $table->string('kelas_id')->nullable(); // Use string for phone number to accommodate any non-numeric characters
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
