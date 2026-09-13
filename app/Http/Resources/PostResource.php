<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'titulo' => $this->titulo,
            'categoria' => $this->categoria,
            'resumo' => $this->resumo,
            'conteudo' => $this->conteudo,
            'imagem_capa' => $this->imagem_capa ? asset($this->imagem_capa) : null,
            'autor' => $this->autor,
            'tempo_leitura' => $this->tempo_leitura,
            'publicado_em' => $this->publicado_em ? $this->publicado_em->format('d/m/Y') : null,
            'destaque' => $this->destaque,
        ];
    }
}
