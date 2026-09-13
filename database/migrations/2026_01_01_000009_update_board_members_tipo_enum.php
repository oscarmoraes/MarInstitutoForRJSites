<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE board_members MODIFY COLUMN tipo ENUM('DIRETORIA', 'REPRESENTANTE', 'HONORARIO', 'COMISSAO') NOT NULL DEFAULT 'DIRETORIA'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE board_members MODIFY COLUMN tipo ENUM('DIRETORIA', 'REPRESENTANTE', 'HONORARIO') NOT NULL DEFAULT 'DIRETORIA'");
    }
};
