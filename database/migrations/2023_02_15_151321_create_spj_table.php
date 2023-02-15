<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSPJTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kegiatan_id');
            $table->bigInteger('subkegiatan_id');
            $table->bigInteger('rekening_id');
            $table->text('uraian');
            $table->string('kwitansi');
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->string('jenis_spm');
            $table->string('file');
            $table->bigInteger('status');
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
        Schema::dropIfExists('spj');
    }
}
