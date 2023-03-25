<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RKA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rka', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rekening_id');
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
