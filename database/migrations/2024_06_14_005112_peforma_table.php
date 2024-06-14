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
        Schema::create('peforma', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('kode_peforma')->index();
            $table->string('nama',50);
            $table->timestamps();
            $table->primary('kode_peforma');
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
