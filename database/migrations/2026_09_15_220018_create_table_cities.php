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
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('state_id')->nullable()->default(null);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('no action')->onUpdate('no action');

            $table->string('title');
            $table->integer('iso')->nullable(true);
            $table->integer('iso_ddd')->nullable(true);
            $table->integer('status')->default(1);
            $table->string('slug')->nullable(true);
            $table->integer('population')->nullable(true);

            $table->decimal('lat', 12, 8)->nullable(true);
            $table->decimal('long', 12, 8)->nullable(true);
            $table->decimal('income_per_capita', 8, 2)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};