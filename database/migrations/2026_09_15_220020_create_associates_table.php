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
        Schema::create('associates', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->string('full_name');
            $table->string('cpf', 14)->unique();
            $table->string('oab_number', 20)->nullable();
            $table->char('oab_uf', 2)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email')->unique();
            $table->string('phone_primary', 20);
            $table->string('phone_secondary', 20)->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('status', [
                'pending',
                'active',
                'inactive',
                'blocked'
            ])->default('pending');
            $table->ipAddress('registration_ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('lgpd_acceptance')->default(false);
            $table->timestamp('lgpd_acceptance_date')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associates');
    }
};
