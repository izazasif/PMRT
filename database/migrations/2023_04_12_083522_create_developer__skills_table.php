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
        Schema::create('developer__skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id');
            $table->foreignId('technology_id');
            $table->enum('expertise_level', ['Beginner','Mid','Intermediate', 'Advanced','Expert']);
            $table->foreign('developer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer__skills');
    }
};
