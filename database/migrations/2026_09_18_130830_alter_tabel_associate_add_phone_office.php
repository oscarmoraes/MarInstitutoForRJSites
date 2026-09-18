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
        Schema::table('associates', function (Blueprint $table) {
            //add phone_office column
            $table->string('phone_office')->nullable()->after('phone_secondary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('associates', function (Blueprint $table) {
            //
            $table->dropColumn('phone_office');
        });
    }
};
