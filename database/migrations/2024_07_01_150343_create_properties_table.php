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
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained(); 
            // $table->foreignUuid('user_id');
            // $table->uuid('user_id')->nullable(false);
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('price');
            $table->string('location');
            $table->text('description');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->integer('electricity');
            $table->integer('surfaceArea');
            $table->integer('buildingArea');
            $table->string('status');
            $table->string('type');
            // $table->string('slug')->unique();
            // $table->string('image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
