<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->unsignedBigInteger('subkegiatan_id');
            $table->foreign('subkegiatan_id')->references('id')->on('subkegiatan')->onDelete('cascade');
            $table->string('pagu_rekening')->default(0);
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
        Schema::dropIfExists('rekening');
    }
}
