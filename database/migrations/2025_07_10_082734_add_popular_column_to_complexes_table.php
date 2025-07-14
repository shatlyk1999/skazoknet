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
        Schema::table('complexes', function (Blueprint $table) {
            if (!Schema::hasColumn('complexes', 'popular')) {
                $table->boolean('popular')->default(false);
            }
        });
        Schema::table('developers', function (Blueprint $table) {
            if (!Schema::hasColumn('developers', 'popular')) {
                $table->boolean('popular')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complexes', function (Blueprint $table) {
            //
        });
    }
};
