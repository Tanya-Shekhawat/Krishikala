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
        Schema::create('seasoncrops', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('season');
            $table->string('crops');
            $table->string('area');
            $table->string('fertilizer');
            $table->string('cropamount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasoncrops');
    }
};
