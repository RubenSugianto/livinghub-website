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
            $table->decimal('price', 20, 2);
            $table->unsignedBigInteger('price');
            $table->string('city');
            $table->string('location');
            $table->string('full_location');
            $table->text('description');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->unsignedInteger('electricity');
            $table->unsignedBigInteger('surfaceArea');
            $table->unsignedBigInteger('buildingArea');
            $table->string('status')->default('Pending');
            $table->string('type');
            $table->string('check')->default('Pending');
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
