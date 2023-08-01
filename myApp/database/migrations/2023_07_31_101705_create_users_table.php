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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('mobile')->nullable()->default(null);
            $table->string('type')->default('User');
            $table->string('manager')->nullable()->default(null);;
            $table->foreign('username')->references('username')->on('system__accounts');
            $table->foreign('manager')->references('email')->on('account__managers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
