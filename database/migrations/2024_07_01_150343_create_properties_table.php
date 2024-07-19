<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
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
            $table->integer('like_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
