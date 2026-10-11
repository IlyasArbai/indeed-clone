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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('resume');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('city');
            $table->enum('status', ['active', 'blocked'])->default('active');

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
        Schema::dropIfExists('users');
    }
};
