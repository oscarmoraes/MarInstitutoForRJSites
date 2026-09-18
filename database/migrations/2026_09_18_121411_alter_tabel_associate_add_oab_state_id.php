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
            //remover 'oab_uf', 2 para adicionar oab_state_id
            $table->dropColumn('oab_uf');
            $table->unsignedInteger('oab_state_id')->nullable()->default(null)->after('oab_number');
            $table->foreign('oab_state_id')->references('id')->on('states')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('associates', function (Blueprint $table) {
            $table->dropColumn('oab_state_id');
            $table->char('oab_uf', 2)->nullable();
        });
    }
};
