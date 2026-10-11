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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('city');
            $table->enum('job_type', ['Full-time', 'Part-time', 'Remote', 'Internship', 'Temporary']);
            $table->integer('positions_available');
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->string('requirements');
            $table->timestamp('expires_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
