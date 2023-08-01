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
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('mobile')->nullable()->default(null);
            $table->string('type')->default('Admin');
            $table->foreign('username')->references('username')->on('system__accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
