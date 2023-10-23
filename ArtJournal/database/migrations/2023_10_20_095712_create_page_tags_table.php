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
        Schema::create('page_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_tag');
    }
};
