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
            $table->string("title_uz");
            $table->string("title_ru")->nullable();
            $table->text("body_uz");
            $table->text("body_ru")->nullable();
            $table->string("image");
            $table->string("slug")->unique();
            $table->json("tags")->nullable();
            $table->foreignId("category_id")->constrained();
            $table->unsignedMediumInteger("views")->default(0);
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
