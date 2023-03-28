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
            $table->bigInteger('january')->default(0);
            $table->bigInteger('february')->default(0);
            $table->bigInteger('march')->default(0);
            $table->bigInteger('april')->default(0);
            $table->bigInteger('may')->default(0);
            $table->bigInteger('june')->default(0);
            $table->bigInteger('july')->default(0);
            $table->bigInteger('august')->default(0);
            $table->bigInteger('september')->default(0);
            $table->bigInteger('october')->default(0);
            $table->bigInteger('november')->default(0);
            $table->bigInteger('december')->default(0);
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
