<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowSisa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening', function (Blueprint $table) {
            $table->string('sisa_rekening')->after('pagu_rekening')->nullable();
        });
        Schema::table('subkegiatan', function (Blueprint $table) {
            $table->string('sisa_sub')->after('pagu_sub')->nullable();
        });
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->string('sisa_kegiatan')->after('pagu_kegiatan')->nullable();
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
