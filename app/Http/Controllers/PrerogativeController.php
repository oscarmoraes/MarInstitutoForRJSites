<?php

namespace App\Http\Controllers;

use App\Models\PrerogativeClaim;
use Illuminate\Http\Request;

class PrerogativeController extends Controller
{
    public function index()
    {
        return view('prerrogativas');
    }

    public function store(Request $request)
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

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Acionamento emergencial registrado com sucesso!',
                'protocolo' => $protocolo,
                'claim' => $claim,
            ]);
        }

        return redirect()->back()->with('success', "Acionamento emergencial registrado sob protocolo Nº {$protocolo}.");
    }
}
