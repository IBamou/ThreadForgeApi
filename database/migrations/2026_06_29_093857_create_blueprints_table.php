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
        Schema::create('blueprints', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('name');

            $table->text('description')->nullable();

            $table->string('tone');

            $table->string('target_platform')->default('x');

            $table->integer('max_length')->default(280);

            $table->json('structure_rules')->nullable();

            $table->json('style_rules')->nullable();

            $table->json('hashtag_strategy')->nullable();

            // $table->json('ai_config')->nullable();
            // $table->boolean('is_active')->default(true);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blueprints');
    }
};
