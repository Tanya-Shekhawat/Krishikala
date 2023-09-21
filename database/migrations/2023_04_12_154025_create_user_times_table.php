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
        Schema::create('user_times', function (Blueprint $table) {
            $table->id();
            $table->date('assigned_date');
            $table->string('assigned_by');
            $table->string('main_station_name');
            $table->string('main_station_pincode');
            $table->string('main_station_address');
            $table->json('assigned_to');
            $table->string('assigned_address');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_times');
    }
};
