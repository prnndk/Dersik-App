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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->foreignId('kelas');
            $table->integer('status');
            $table->string('instansi')->length(120);
            $table->string('detail_status')->length(120);
            $table->integer('domisili');
            $table->foreignId('user_id');
            $table->foreignId('angkatan_id');
            $table->string('teman_smasa')->length(100);
            $table->bigInteger('nomor')->length(15);
            $table->integer('review')->default(0)->length(1);
            $table->string('message');
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
        Schema::dropIfExists('siswas');
    }
};
