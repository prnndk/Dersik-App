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
        Schema::create('detailstatuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_status')->constrained('statuses','id')->onDelete('cascade');
            $table->string('nama');
            $table->string('kode')->length(10);
            $table->string('jenis')->length(10);
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
        Schema::dropIfExists('detailstatuses');
    }
};
