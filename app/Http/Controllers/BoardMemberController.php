<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use App\Models\Member;
use App\Models\State;
use Illuminate\Http\Request;

class BoardMemberController extends Controller
{
    public function diretoria()
    {
        $directors = BoardMember::where('tipo', 'DIRETORIA')->orderBy('ordem')->get();
        $commissions = BoardMember::where('tipo', 'COMISSAO')->orderBy('ordem')->get();

        return view('diretoria-e-comissoes', compact('directors', 'commissions'));
    }

    public function representantes(Request $request)
    {
        $selectedUf = $request->input('uf', 'TODOS');

        $query = Member::where('status', 'ATIVO')->with('state');

        // Se foi selecionado um UF específico, filtra pelo relacionamento
        if (!empty($selectedUf) && $selectedUf !== 'TODOS') {
            $query->whereHas('state', function ($q) use ($selectedUf) {
                $q->where('letter', $selectedUf);
            });
        }

        $representatives = $query->orderBy('nome')->get();

        // Buscar lista de UFs disponíveis entre os membros ativos
        $ufs = State::whereIn('id', function ($sub) {
                $sub->select('state_id')
                    ->from('members')
                    ->where('status', 'ATIVO')
                    ->whereNotNull('state_id');
            })
            ->orderBy('letter')
            ->pluck('letter');

        return view('representantes', compact('representatives', 'ufs', 'selectedUf'));
    }

    public function membrosHonorarios()
    {
        $honoraryMembers = BoardMember::where('tipo', 'HONORARIO')->with('state')->orderBy('ordem')->get();

        return view('membros-honorarios', compact('honoraryMembers'));
    }
}
