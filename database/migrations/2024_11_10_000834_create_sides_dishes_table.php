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
        Schema::create('sides_dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 60)->nullable();
            $table->float('price', 8, 2, true)->nullable();
            $table->decimal('portion_quantity', 6, 2, true);
            $table->boolean('is_active');
            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')
                ->on('restaurants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sides_dishes');
    }
};
