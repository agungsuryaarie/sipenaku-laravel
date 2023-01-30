<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->id();
            $table->string('nama_detail')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->string('koefisien1')->nullable();
            $table->string('koefisien2')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga')->nullable();
            $table->string('jumlah')->default(0);
            // $table->unsignedBigInteger('kegiatan_id');
            // $table->unsignedBigInteger('subkegiatan_id');
            $table->unsignedBigInteger('rekening_id');
            // $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
            // $table->foreign('subkegiatan_id')->references('id')->on('subkegiatan')->onDelete('cascade');
            $table->foreign('rekening_id')->references('id')->on('rekening')->onDelete('cascade');
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
        Schema::dropIfExists('detail');
    }
}
