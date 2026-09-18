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
        Schema::table('board_members', function (Blueprint $table) {
            //add state_id column to board_members table
            $table->unsignedInteger('state_id')->nullable()->default(null);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_members', function (Blueprint $table) {
            $table->dropForeign('board_members_state_id_foreign');
            $table->dropColumn('state_id');
        });
    }
};
