<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('planned');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->string('document_no')->unique();
            $table->string('title');
            $table->string('file_name');
            $table->string('file_path', 500);
            $table->string('file_type', 20);
            $table->unsignedBigInteger('file_size');
            $table->json('metadata')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedInteger('current_version')->default(1);
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();
        });

        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('workflow_step_id');
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->string('status')->default('pending');
            $table->text('comments')->nullable();
            $table->timestamp('acted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('transmittals', function (Blueprint $table) {
            $table->id();
            $table->string('transmittal_no')->unique();
            $table->unsignedBigInteger('project_id');
            $table->enum('direction', ['incoming', 'outgoing']);
            $table->string('subject');
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('sent_by');
            $table->string('sent_to')->nullable();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->string('target_type');
            $table->unsignedBigInteger('target_id')->nullable();
            $table->json('payload')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('transmittals');
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('roles');
    }
};
