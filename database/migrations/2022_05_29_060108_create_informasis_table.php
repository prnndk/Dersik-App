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
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('oleh')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_informasi')->constrained('kateginfos','id')->onDelete('cascade');
            $table->foreignId('angkatan')->constrained('angkatans','id')->onDelete('cascade');
            $table->string('img')->nullable();
            $table->string('slug', 100);
            $table->bigInteger('informasi_type');
            $table->boolean('active');
            $table->boolean('shortlink');
            $table->string('shortened')->nullable();
            $table->text('body');
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
        Schema::dropIfExists('informasis');
    }
};
