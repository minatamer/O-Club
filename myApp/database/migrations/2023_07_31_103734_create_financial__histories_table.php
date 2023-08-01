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
        Schema::create('financial__histories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('amount')->unsigned();
            $table->string('sender');
            $table->string('receiver');
            $table->foreign('sender')->references('username')->on('system__accounts');
            $table->foreign('receiver')->references('username')->on('system__accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial__histories');
    }
};
