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
        Schema::create('musiques', function (Blueprint $table) {
            $table->id();
            $table->text('titre');
            $table->time('duree');
            $table->decimal('prix', 10, 2);
            $table->boolean('payant');
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
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
        Schema::dropIfExists('musiques');
    }
};
