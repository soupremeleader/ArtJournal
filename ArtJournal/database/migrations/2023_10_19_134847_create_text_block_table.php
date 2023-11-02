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
        Schema::create('text_blocks', function (Blueprint $table) {
            $table->id();

            $table->integer('width');
            $table->integer('height');
            $table->integer('pos_x');
            $table->integer('pos_y');
            $table->text('content');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('page_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_blocks');
    }
};
