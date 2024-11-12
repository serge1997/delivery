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
        Schema::create('menuitem_side_dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menuitem_id')->unsigned();
            $table->integer('side_dishe_id')->unsigned();
            $table->foreign('menuitem_id')->references('id')
                ->on('menu_items')->onDelete('cascade');
            $table->foreign('side_dishe_id')->references('id')
                ->on('sides_dishes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menuitem_side_dishes');
    }
};
