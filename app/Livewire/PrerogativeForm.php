<?php

namespace App\Livewire;

use App\Models\PrerogativeClaim;
use Livewire\Component;

class PrerogativeForm extends Component
{
    public $adv_nome = '';

    public $adv_oab = '';

    public $adv_uf = 'SP';

    public $adv_email = '';

    public $adv_phone = '';

    public $tipo_violacao = '';

    public $orgao_local = '';

    public $autor_atentado = '';

    public $processo_num = '';

    public $descricao_fatos = '';

    public $submitted = false;

    public $protocolo = '';

    protected $rules = [
        'adv_nome' => 'required|min:3',
        'adv_oab' => 'required',
        'adv_uf' => 'required',
        'adv_email' => 'required|email',
        'adv_phone' => 'required',
        'tipo_violacao' => 'required',
        'orgao_local' => 'required',
        'descricao_fatos' => 'required|min:10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validated = $this->validate();

        $this->protocolo = 'PRE-'.date('Y').'-'.sprintf('%04d', rand(1, 9999));

        PrerogativeClaim::create(array_merge($validated, [
            'protocolo' => $this->protocolo,
            'autor_atentado' => $this->autor_atentado,
            'processo_num' => $this->processo_num,
            'status' => 'RECEBIDO',
        ]));

        $this->submitted = true;
    }

    public function resetForm()
    {
        $this->reset(['adv_nome', 'adv_oab', 'adv_email', 'adv_phone', 'tipo_violacao', 'orgao_local', 'autor_atentado', 'processo_num', 'descricao_fatos', 'submitted', 'protocolo']);
    }

    public function render()
    {
        return view('livewire.prerogative-form');
    }
}
