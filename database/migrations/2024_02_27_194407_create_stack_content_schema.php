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
        Schema::create('stackable_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
        });

        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('stackable_content_id')->constrained();
            $table->string('block_type');
            $table->integer('sort')->nullable();
            $table->json('content')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }
};
