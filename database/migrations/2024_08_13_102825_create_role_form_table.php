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
        Schema::create('role_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('role_id');
            $table->json('form_data'); // Store all form data as JSON
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade'); // Optional: Delete projects if a client is deleted

            // Add foreign key constraint
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade'); // Optional: Delete projects if a client is deleted

            // Add unique constraint for the combination of project_id and role_id
            $table->unique(['project_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_form');
    }
};
