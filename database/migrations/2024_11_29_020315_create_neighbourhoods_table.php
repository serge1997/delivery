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
        Schema::create('neighbourhoods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('municipality_id')->unsigned()->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->foreign('city_id')->references('id')
                ->on('cities');
            $table->foreign('municipality_id')->references('id')
                ->on('municipalities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neighbourhoods');
    }
};
