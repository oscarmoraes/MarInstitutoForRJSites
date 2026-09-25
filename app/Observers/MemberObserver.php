<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function creating(Member $member)
    {
        // Gerar UUID antes de criar o registro
        $member->matricula = (string) \Illuminate\Support\Str::orderedUuid();
        if ($member->categoria === null) {
            $member->categoria = "";
        }
        $member->comissao = "1";
        $member->uf = "OO";
        $member->validade = now();
        $member->hash_validacao = (string) \Illuminate\Support\Str::orderedUuid();
    }

    public function updating(Member $member)
    {
        if ($member->categoria === null) {
            $member->categoria = "";
        }
    }
}