<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'matricula' => $this->matricula,
            'nome' => $this->nome,
            'oab' => $this->oab,
            'uf' => $this->uf,
            'oab_uf' => "{$this->oab}/{$this->uf}",
            'categoria' => $this->categoria,
            'comissao' => $this->comissao,
            'status' => $this->status,
            'validade' => $this->validade ? $this->validade->format('d/m/Y') : null,
            'foto_url' => $this->foto_url ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80',
            'hash_validacao' => $this->hash_validacao,
            'qr_code_url' => route('certificados.validar', ['codigo' => $this->hash_validacao ?? 'MAR-2026-98421']),
        ];
    }
}
