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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('configuration_id')->constrained('configurations')->cascadeOnDelete();

            $table->string('title');
            $table->string('hook_proposal')->nullable();

            $table->json('body_points')->nullable();
            $table->json('suggested_hashtags')->nullable();

            $table->integer('technical_readability_score')->nullable();

            $table->text('tone_compliance_justification')->nullable();

            $table->string('process_status')->default('pending');
            $table->string('status')->default('in_review');

            $table->json('ai_payload')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
