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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->time('open_hour')->nullable();
            $table->time('close_hour')->nullable();
            $table->string('enterprise_register_number')->nullable();
            $table->string('created_by_name');
            $table->string('created_by_phone');
            $table->string('created_by_email')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
