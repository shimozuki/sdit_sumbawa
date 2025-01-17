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
        Schema::create('tahsin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('kode_tahsin')->index();
            $table->string('nama',50);
            $table->timestamps();
            $table->primary('kode_tahsin');
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
