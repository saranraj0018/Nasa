<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique()->comment('e.g. 2025-2029');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pre-fill with batches already used by students / event schedules
        // so existing records keep matching a dropdown option.
        $existing = DB::table('students')->whereNotNull('batch')->distinct()->pluck('batch')
            ->merge(DB::table('event_schedules')->whereNotNull('batch')->distinct()->pluck('batch'))
            ->map(fn ($b) => trim((string) $b))
            ->filter(fn ($b) => preg_match('/^\d{4}-\d{4}$/', $b))
            ->unique()
            ->sort()
            ->values();

        $now = now();
        DB::table('batches')->insert(
            $existing->map(fn ($name) => ['name' => $name, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now])->all()
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
