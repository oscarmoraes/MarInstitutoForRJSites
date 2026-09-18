<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Member;
use App\Models\State;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        return view('seja-um-associado');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:25',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'telefone' => 'nullable|string|max:50',
            'oab' => 'required|string|max:50',
            'uf' => 'required|string|max:10',
            'categoria' => 'nullable|string|max:100',
        ]);

        $matricula = '#2026-'.sprintf('%04d', rand(1000, 9999));
        $phone = $validated['whatsapp'] ?? $validated['telefone'] ?? null;

        $member = Member::create([
            'matricula' => $matricula,
            'nome' => $validated['nome'],
            'cpf' => $validated['cpf'] ?? null,
            'email' => $validated['email'],
            'telefone' => $phone,
            'oab' => $validated['oab'],
            'uf' => $validated['uf'],
            'categoria' => !empty($validated['categoria']) ? $validated['categoria'] : 'Advogado Efetivo',
            'status' => 'PENDENTE',
            'validade' => now()->addYear(),
            'hash_validacao' => strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Solicitação de associação enviada com sucesso! Sua matrícula provisória é '.$matricula,
                'matricula' => $matricula,
                'member' => $member,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Sua solicitação de associação foi submetida com sucesso ao comitê de admissão!')
            ->with('matricula', $matricula);
    }
}
