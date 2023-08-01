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
        Schema::create('system__accounts', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->string('email');
            $table->string('mobile')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system__accounts');
    }
};
