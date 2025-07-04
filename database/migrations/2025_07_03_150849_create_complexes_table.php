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
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id');
            $table->foreignId('developer_id')->nullable();
            $table->string('name');
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort')->nullable();
            $table->string('address')->nullable();
            $table->string('map_x')->nullable();
            $table->string('map_y')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complexes');
    }
};
