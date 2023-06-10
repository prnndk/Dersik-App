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
        Schema::create('korwils', function (Blueprint $table) {
            $table->id();
            $table->char('kota_id',4);
            $table->foreign('kota_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('PJ');
            $table->bigInteger('number')->length(20);
            $table->string('kontaklain');
            $table->foreignId('siswa_id')->constrained('users', 'id')->onDelete('cascade');
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
        Schema::dropIfExists('korwils');
    }
};
