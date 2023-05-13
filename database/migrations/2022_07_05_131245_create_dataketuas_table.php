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
        Schema::create('dataketuas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ketua_id')->constrained('ketuas', 'id')->onDelete('cascade');
            $table->foreignId('kelas')->constrained('kelas', 'id')->onDelete('cascade');
            $table->char('tempatlahir',4);
            $table->foreign('tempatlahir')->references('id')->on('regencies')->onDelete('cascade');
            $table->date('dob');
            $table->text('pengalaman');
            $table->string('ig')->length(50);
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
        Schema::dropIfExists('dataketuas');
    }
};
