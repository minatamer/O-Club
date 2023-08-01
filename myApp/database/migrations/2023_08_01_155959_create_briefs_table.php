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
        Schema::create('briefs', function (Blueprint $table) {
            $table->increments('brief_id');
            $table->string('project');
            $table->text('description'); 
            $table->integer('user_id')->unsigned();
            $table->dateTime('date');
            $table->string('status')->default('TBA');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('briefs');
    }
};
