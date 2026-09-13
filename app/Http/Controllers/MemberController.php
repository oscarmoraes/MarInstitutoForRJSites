<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function card(Request $request)
    {
        $search = trim($request->input('busca', $request->input('matricula', '')));
        $member = null;
        $searched = false;

        if (!empty($search)) {
            $searched = true;
            $cleanSearch = preg_replace('/[^0-9a-zA-Z]/', '', $search);

            $member = Member::where('matricula', $search)
                ->orWhere('matricula', '#' . $search)
                ->orWhere('oab', $search)
                ->orWhere('email', $search)
                ->orWhere('cpf', $search)
                ->when(!empty($cleanSearch), function ($q) use ($cleanSearch) {
                    $q->orWhereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?", [$cleanSearch]);
                })
                ->orWhere('nome', 'LIKE', "%{$search}%")
                ->first();
        } else {
            // Exibição demonstrativa padrão
            $member = Member::where('status', 'ATIVO')->first() ?? Member::first();
        }

        return view('membro.carteirinha', compact('member', 'search', 'searched'));
    }
}
