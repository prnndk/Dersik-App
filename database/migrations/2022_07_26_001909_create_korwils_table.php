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
        Schema::create('korwils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_id');
            $table->string('PJ');
            $table->bigInteger('number')->length(20);
            $table->string('kontaklain');
            $table->foreignId('siswa_id');
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
