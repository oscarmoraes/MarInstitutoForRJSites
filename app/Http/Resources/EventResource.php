<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'data_evento' => $this->data_evento ? $this->data_evento->format('Y-m-d H:i:s') : null,
            'data_formatada' => $this->data_evento ? $this->data_evento->format('d/m/Y \à\s H:i') : null,
            'local' => $this->local,
            'vagas_totais' => $this->vagas_totais,
            'vagas_preenchidas' => $this->registrations()->where('status', 'confirmado')->count(),
            'formato' => $this->formato,
            'carga_horaria' => $this->carga_horaria,
            'ativo' => $this->ativo,
        ];
    }
}
