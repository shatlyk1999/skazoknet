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
            if (!Schema::hasColumn('complexes', 'slug')) {
                $table->string('slug');
            }
        });
        Schema::table('developers', function (Blueprint $table) {
            if (!Schema::hasColumn('developers', 'slug')) {
                $table->string('slug');
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role');
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
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
