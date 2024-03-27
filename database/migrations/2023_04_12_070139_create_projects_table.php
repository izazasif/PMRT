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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client_spoke_name')->nullable();
            $table->string('client_spoke_mobile')->nullable();
            $table->string('client_spoke_email')->nullable()->unique();
            $table->string('miaki_spoke_name')->nullable();
            $table->string('miaki_spoke_mobile')->nullable();
            $table->string('miaki_spoke_email')->nullable()->unique();
            $table->string('customer_name')->nullable();
            $table->string('srs_pdf')->nullable();
            $table->string('ui_ux_link')->nullable();
            $table->string('rep_link')->nullable();
            $table->datetime('timeline')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('project_stage_id');
            $table->foreign('project_stage_id')->references('id')->on('project_stages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
