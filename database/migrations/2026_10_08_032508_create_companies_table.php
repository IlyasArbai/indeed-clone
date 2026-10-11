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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'verified', 'blocked', 'rejected'])->default('pending');

            $table->timestamp('verified_at')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null')->nullable();

            $table->foreignId('account_id')
                ->unique()
                ->constrained('accounts')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
