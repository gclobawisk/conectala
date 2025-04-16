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
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamp('last_updated');
            $table->float('temp_c');
            $table->float('temp_f');
            $table->boolean('is_day');
            $table->string('condition_text');
            $table->string('condition_icon');
            $table->float('wind_kph');
            $table->integer('humidity');
            $table->integer('cloud');
            $table->float('feelslike_c');
            $table->float('uv');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};
