<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TW extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_id');
            $table->unsignedBigInteger('subkegiatan_id');
            $table->unsignedBigInteger('rekening_id');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan');
            $table->foreign('subkegiatan_id')->references('id')->on('subkegiatan');
            $table->foreign('rekening_id')->references('id')->on('rekening');
            $table->bigInteger('1')->default(0);
            $table->bigInteger('2')->default(0);
            $table->bigInteger('3')->default(0);
            $table->bigInteger('4')->default(0);
            $table->bigInteger('5')->default(0);
            $table->bigInteger('6')->default(0);
            $table->bigInteger('7')->default(0);
            $table->bigInteger('8')->default(0);
            $table->bigInteger('9')->default(0);
            $table->bigInteger('10')->default(0);
            $table->bigInteger('11')->default(0);
            $table->bigInteger('12')->default(0);
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
        //
    }
}
