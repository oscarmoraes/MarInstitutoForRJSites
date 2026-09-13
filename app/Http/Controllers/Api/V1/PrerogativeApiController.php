<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PrerogativeClaim;
use Illuminate\Http\Request;

class PrerogativeApiController extends Controller
{
    public function claim(Request $request)
    {
        $validated = $request->validate([
            'adv_nome' => 'required|string|max:255',
            'adv_oab' => 'required|string|max:50',
            'adv_uf' => 'required|string|max:10',
            'adv_email' => 'required|email|max:255',
            'adv_phone' => 'required|string|max:50',
            'tipo_violacao' => 'required|string|max:255',
            'orgao_local' => 'required|string|max:255',
            'autor_atentado' => 'nullable|string|max:255',
            'processo_num' => 'nullable|string|max:100',
            'descricao_fatos' => 'required|string',
        ]);

        $protocolo = 'PRE-'.date('Y').'-'.sprintf('%04d', rand(1, 9999));

        $claim = PrerogativeClaim::create(array_merge($validated, [
            'protocolo' => $protocolo,
            'status' => 'RECEBIDO',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Chamado emergencial transmitido com sucesso à Comissão de Prerrogativas!',
            'protocolo' => $protocolo,
            'data' => $claim,
        ], 201);
    }

    public function myClaims(Request $request)
    {
        $oab = $request->query('oab');
        $claims = PrerogativeClaim::when($oab, function ($query, $oab) {
            return $query->where('adv_oab', $oab);
        })->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $claims,
        ]);
    }
}
