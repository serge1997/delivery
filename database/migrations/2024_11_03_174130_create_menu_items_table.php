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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('price', 6, 2);
            $table->integer('restaurant_id')->unsigned();
            $table->integer('restaurant_food_type_id')->nullable()->unsigned();
            $table->integer('restaurant_category_id')->nullable()->unsigned();
            $table->boolean('is_active')->default(false);
            $table->string('image');
            $table->foreign('restaurant_id')->references('id')
                ->on('restaurants')->onDelete('cascade');
            $table->foreign('restaurant_food_type_id')->references('id')
                ->on('restaurants_food_types')->onDelete('set null');
            $table->foreign('restaurant_category_id')->references('id')
                ->on('restaurants_categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
