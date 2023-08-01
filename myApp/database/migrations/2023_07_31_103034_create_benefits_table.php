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
        Schema::create('benefits', function (Blueprint $table) {
            $table->increments('benefit_id');
            $table->string('name');
            $table->text('description'); 
            $table->tinyInteger('redeemed')->default(0); 
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};
