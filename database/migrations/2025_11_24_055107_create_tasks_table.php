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
        // Schema::create('tasks', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('admin_id')->constrained('admins')->onDelete('no action');
        //     $table->string('title');
        //     $table->string('description');
        //     $table->enum('priority', ['low', 'medium', 'high']);
        //     $table->date('deadline_date');
        //     $table->string('banner_image');
        //     $table->enum('status', ['pending', 'completed'])->default('pending');
        //     $table->timestamps();
        // });

        Schema::create('task_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('no action');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type', 50)->nullable();
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
