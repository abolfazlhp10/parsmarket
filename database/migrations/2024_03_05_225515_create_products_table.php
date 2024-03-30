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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('title_fa');
            $table->string('title_en');
            $table->string('slug');
            $table->text('body');
            $table->string('image');
            $table->integer('price');
            $table->integer('dis_price')->nullable();
            $table->integer('dis_percent')->nullable();
            $table->string('brand');
            $table->string('gr');
            $table->string('seller');
            $table->text("options");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
