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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('station_name');
            $table->string('case_category');
            $table->integer('assigned_to');
            $table->integer('assigned_by');
            $table->enum('status',["Completed","NotCompleted"])->default("NotCompleted");
            $table->date('assigned_date');
            $table->date('completed_date');
            $table->string('case_location');
            $table->text('user_message')->nullable();
            $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
