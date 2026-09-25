<?php

namespace App\Models;

use App\Observers\MemberObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Support\Facades\DB;

#[ObservedBy(MemberObserver::class)]
class Member extends Model
{
    use HasFactory;

    //Representantes e coordenadores regionais do Instituto MAR

    protected $fillable = [
        'matricula',
        'nome',
        'cpf',
        'email',
        'telefone',
        'oab',
        'uf',
        'categoria',
        'comissao',
        'status',
        'validade',
        'foto_url',
        'hash_validacao',
        'state_id',
    ];

    protected $casts = [
        'validade' => 'date',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function getMemberGroupStateToHome()
    {
        // Lista de estados que você quer limitar
        $estados = [
            'SP' => 'São Paulo',
            'RJ' => 'Rio de Janeiro',
            'MG' => 'Minas Gerais',
            'BA' => 'Bahia',
            'RS' => 'Rio Grande do Sul',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'SC' => 'Santa Catarina',
            'GO' => 'Goiás',
        ];

        // Query com join entre members e states
        $counts = DB::table('members')
            ->join('states', 'members.state_id', '=', 'states.id')
            ->select('states.letter', DB::raw('COUNT(members.id) as total'))
            ->whereIn('states.letter', array_keys($estados))
            ->groupBy('states.letter')
            ->pluck('total', 'letter'); // retorna ['SP' => 14, 'RJ' => 9, ...]

        // Monta o retorno no formato desejado
        $resultado = [];
        foreach ($estados as $sigla => $nome) {
            $resultado[$sigla] = [
                'name' => $nome,
                'reps' => $counts[$sigla] ?? 0,
            ];
        }

        return response()->json($resultado);
    }
}
