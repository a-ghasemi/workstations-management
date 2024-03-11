<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->nullable()->default(null)->unique();
            $table->foreignId('workstation_id')->nullable()->default(null)->constrained('workstations')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('component_types')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('component_categories')->cascadeOnDelete();
            $table->string('make');
            $table->string('model');
            $table->json('properties')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
