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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_description')->nullable();
            $table->integer('profile_population')->nullable();
            $table->string('profile_profession')->nullable();
            $table->float('profile_area')->nullable();
            $table->longText('profile_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
