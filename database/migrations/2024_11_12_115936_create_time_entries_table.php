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
        Schema::create('time_entries', function (Blueprint $table) {
            $table->string('id')->unique(true)->primary(true);
            $table->string('description');
            $table->string('project_id')->nullable();
            $table->string('task_id')->nullable();
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->json('payload');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
