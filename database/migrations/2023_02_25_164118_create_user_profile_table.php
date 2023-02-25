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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            //foreign key to user table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //adresss
            $table->string('address')->nullable();
            //city
            $table->string('city')->nullable();
            //state
            $table->string('province')->nullable();
            //profession
            $table->string('profession')->nullable();
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
        Schema::dropIfExists('user_profile');
    }
};
