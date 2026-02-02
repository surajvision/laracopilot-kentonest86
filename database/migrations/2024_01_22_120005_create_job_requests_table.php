<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->json('evaluation_answers');
            $table->string('unique_number')->nullable()->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('completion_status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->text('completion_notes')->nullable();
            $table->string('completion_proof_path')->nullable();
            $table->timestamp('number_assigned_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_requests');
    }
};