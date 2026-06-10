<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('musique_playlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musique_id');
            $table->unsignedBigInteger('playlist_id');

            $table->foreign('musique_id')
                ->references('id')
                ->on('musiques')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('playlist_id')
                ->references('id')
                ->on('playlists')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musique_playlist');
    }
};
