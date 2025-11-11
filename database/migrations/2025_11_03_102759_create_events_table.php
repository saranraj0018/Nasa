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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_number')->nullable();
            $table->string('role')->default('admin');
            $table->string('code')->nullable();
            $table->timestamps();
        });

        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });

        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('no action');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained('clubs')->onDelete('no action');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('no action');
            $table->string('title');
            $table->text('description');
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location');
            $table->enum('session', ['1', '2'])
                ->comment('1 FN, 2 AN');  // e.g. FN, AN
            $table->text('eligibility_criteria');
            $table->date('end_registration');
            $table->foreignId('contact_person')->constrained('admin')->onDelete('no action');
            $table->string('contact_email');
            $table->string('banner_image')->nullable(); // store image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
