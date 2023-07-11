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
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->smallInteger('id', true, true);
            $table->unsignedSmallInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedSmallInteger('penyakit_id')->nullable();
            $table->foreign('penyakit_id')->references('id')->on('penyakit');
            $table->json('answer_log');
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
        Schema::dropIfExists('diagnosa');
    }
};
