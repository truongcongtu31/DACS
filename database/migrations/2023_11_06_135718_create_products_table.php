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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->string('image');
            $table->string('image_detail_1');
            $table->string('image_detail_2');
            $table->string('image_detail_3');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('tag');
            $table->bigInteger('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
