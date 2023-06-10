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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->foreignId('kelas')->constrained('kelas', 'id')->onDelete('cascade');
            $table->foreignId('status')->constrained('statuses', 'id')->onDelete('cascade');
            $table->string('instansi')->length(120);
            $table->string('detail_status')->length(120);
            $table->char('domisili', 4);
            $table->foreign('domisili')->references('id')->on('regencies')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('angkatan_id')->constrained('angkatans', 'id')->onDelete('cascade');
            $table->string('teman_smasa')->length(100);
            $table->integer('banyak_teman')->length(3)->nullable();
            $table->bigInteger('nomor')->length(15);
            $table->integer('review')->default(0)->length(1);
            $table->string('message');
            $table->uuid('url');
            $table->integer('pengajuan')->default(0)->length(1);
            $table->ipAddress('ip');
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
