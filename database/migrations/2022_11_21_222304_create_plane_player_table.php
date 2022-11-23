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
        Schema::create('plane_player', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreignId('plane_id')->references('id')->on('planes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plane_player');
    }
};
