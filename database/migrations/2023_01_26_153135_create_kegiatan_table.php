<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kegiatan')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->unsignedBigInteger('bagian_id');
            $table->foreign('bagian_id')->references('id')->on('bagian')->onDelete('cascade');
            $table->string('pagu_kegiatan')->default(0);
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
        Schema::dropIfExists('kegiatan');
    }
}
