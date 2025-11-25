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

        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('no action');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('no action');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('faculty_code');
            $table->string('profile_pic')->nullable();
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
            $table->enum('event_type', ['paid','free']);
            $table->integer('seat_count');
            $table->string('location');
            $table->enum('session', ['1', '2'])
                ->comment('1 FN, 2 AN');
            $table->text('eligibility_criteria');
            $table->date('end_registration');
            $table->string('contact_person');
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

     }
};
