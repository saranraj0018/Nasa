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
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('created_by');
            $table->string('title');
            $table->string('description');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->datetime('deadline_date');
            $table->enum('status', ['pending', 'completed','accepted'])->default('pending');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('no action');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('no action');
        });

        Schema::create('task_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type', 50)->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('no action');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('tasks');
    }
};
