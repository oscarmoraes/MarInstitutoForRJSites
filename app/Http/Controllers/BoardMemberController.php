<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
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

        $query = BoardMember::where('tipo', 'REPRESENTANTE');

        if (! empty($selectedUf) && $selectedUf !== 'TODOS') {
            $query->where('uf', $selectedUf);
        }

        $representatives = $query->orderBy('ordem')->get();

        $ufs = BoardMember::where('tipo', 'REPRESENTANTE')
            ->whereNotNull('state_id')
            ->select('state_id')
            ->orderBy('state_id')
            ->pluck('state_id');

        return view('representantes', compact('representatives', 'ufs', 'selectedUf'));
    }

    public function membrosHonorarios()
    {
        $honoraryMembers = BoardMember::where('tipo', 'HONORARIO')->with('state')->orderBy('ordem')->get();

        return view('membros-honorarios', compact('honoraryMembers'));
    }
}
