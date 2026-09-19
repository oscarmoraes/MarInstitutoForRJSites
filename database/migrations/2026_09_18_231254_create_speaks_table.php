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
        Schema::create('speaks', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('slug')->unique();

            $table->string('cargo')->nullable();
            $table->string('foto')->nullable();

            $table->text('mini_bio')->nullable();
            $table->text('biografia')->nullable();

            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('site')->nullable();

            $table->boolean('ativo')->default(true);

            $table->timestamps();

            $table->index(['nome', 'ativo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaks');
    }
};
