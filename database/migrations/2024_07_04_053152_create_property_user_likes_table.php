<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyUserLikesTable extends Migration
{
    public function up()
    {
        Schema::create('property_user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('property_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_user_likes');
    }
}
