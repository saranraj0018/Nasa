<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('user_name');
            $table->unsignedBigInteger('user_id');
            $table->enum('user_type', ['super_admin','admin', 'student']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Schema::dropIfExists('activities');
    }
};
