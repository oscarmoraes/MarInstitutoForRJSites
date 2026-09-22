<?php

namespace App\Enums;

enum ResumeStatus: string
{
    /**
     * novo
        em_analise
        contatado
        arquivado
     */
    case New = 'novo';
    case InAnalysis = 'em_analise';
    case Contacted = 'contatado';
    case Archived = 'arquivado';

    /**
     * Get the label for the status
     */
    public function label(): string
    {
        return match($this) {
            self::New => 'Novo',
            self::InAnalysis => 'Em Análise',
            self::Contacted => 'Contatado',
            self::Archived => 'Arquivado',
        };
    }

    /**
     * Get the color badge for display
     */
    public function color(): string
    {
        return match($this) {
            self::New => 'warning',
            self::InAnalysis => 'success',
            self::Contacted => 'gray',
            self::Archived => 'danger',
        };
    }

    /**
     * Get all available statuses
     */
    public static function all(): array
    {
        return [
            self::New->value,
            self::InAnalysis->value,
            self::Contacted->value,
            self::Archived->value,
        ];
    }
}
