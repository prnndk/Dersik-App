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
        Schema::create('regis_proms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->foreignId('user_id');
            $table->string('nama')->unique();
            $table->string('email')->unique();
            $table->string('kesediaan');
            $table->string('kedinasan');
            $table->date('tanggal')->nullable();
            $table->string('no_hp')->unique();
            $table->string('qr_code')->unique();
            $table->string('statusbayar')->default('Belum Bayar');
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
        Schema::dropIfExists('regis_proms');
    }
};
