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
        Schema::create('student_event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('no action');
            $table->foreignId('event_id')->constrained('events')->onDelete('no action');
            $table->enum('status', ['1', '2','3','4'])->comment('1 - Registered, 2 - Approved, 3 - Completed, 4 - Cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_event_registration');
    }
};
