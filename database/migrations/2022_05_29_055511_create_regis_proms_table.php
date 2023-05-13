<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regis_proms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('kelas_id')->constrained('kelas', 'id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->string('nama')->unique();
            $table->string('email')->unique();
            $table->boolean('kesediaan');
            $table->boolean('kedinasan');
            $table->date('tanggal')->nullable();
            $table->string('no_hp', 15)->unique();
            $table->string('qr_code', 40)->unique();
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
