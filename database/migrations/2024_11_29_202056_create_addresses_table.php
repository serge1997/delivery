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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street_reference');
            $table->integer('city_id')->unsigned();
            $table->integer('municipality_id')->unsigned()->nullable();
            $table->integer('neighbourhood_id')->unsigned();
            $table->double('longitude')->nullable();
            $table->double('latitude');
            $table->boolean('is_street');
            $table->string('zip_code', 15)->nullable();
            $table->foreign('city_id')->references('id')
                ->on('cities');
            $table->foreign('municipality_id')->references('id')
                ->on('municipalities');
            $table->foreign('neighbourhood_id')->references('id')
                ->on('neighbourhoods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
