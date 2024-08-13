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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Ensure it's an unsigned big integer
            $table->string('project_name')->unique();
            $table->string('project_code')->unique();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade'); // Optional: Delete projects if a client is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }

   
};
