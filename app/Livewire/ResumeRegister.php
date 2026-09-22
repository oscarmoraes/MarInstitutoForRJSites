<?php

namespace App\Livewire;

use App\Enums\ResumeStatus;
use App\Models\City;
use App\Models\Resume;
use App\Models\State;
use Faker\Provider\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ResumeRegister extends Component
{
    use WithFileUploads;

    public $nome = '';
    public $email = '';
    public $telefone = '';
    public $telefone_contato = '';
    public $state_id = '';
    public $city_id = '';
    public $linkedin = '';
    public $instagram = '';
    public $site = '';
    public $cargo_atual = '';
    public $area_atuacao = '';
    public $areas_interesse = '';
    public $resumo_profissional = '';
    public $mensagem = '';
    public $curriculo_arquivo;
    public $origem = '';
    public $status = 'novo';
    public $lgpd_consentimento = false;
    public $lgpd_consentimento_em = null;
    public $politica_privacidade_versao = '1.0';

    public $states = [];
    public $cities = [];

    public $showSuccessMessage = false;
    public $showErrorMessage = false;
    public $errorMessage = '';

    public function mount()
    {
        $this->states = State::orderBy('letter')->get();
    }

    protected function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:30',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'curriculo_arquivo' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'lgpd_consentimento' => 'required|accepted',
        ];
    }

    protected $messages = [
        'nome.required' => 'O nome completo é obrigatório.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Informe um e-mail válido.',
        'telefone.required' => 'O telefone é obrigatório.',
        'curriculo_arquivo.required' => 'O currículo é obrigatório.',
        'curriculo_arquivo.file' => 'O currículo deve ser um arquivo válido.',
        'curriculo_arquivo.mimes' => 'O currículo deve estar em PDF, DOC ou DOCX.',
        'curriculo_arquivo.max' => 'O currículo não pode exceder 10MB.',
        'state_id.required' => 'O estado é obrigatório.',
        'state_id.exists' => 'O estado selecionado é inválido.',
        'city_id.required' => 'A cidade é obrigatória.',
        'city_id.exists' => 'A cidade selecionada é inválida.',
        'lgpd_consentimento.required' => 'Você deve aceitar a política de privacidade.',
    ];

    public function save()
    {
        $this->validate();

        try {
            $photoPath = $this->curriculo_arquivo->store('curriculos', 'public');

            //cadastro do resume
            Resume::create([
                'nome' => $this->nome,
                'email' => $this->email,
                'telefone' => $this->telefone,
                'telefone_contato' => $this->telefone_contato,
                'state_id' => $this->state_id,
                'city_id' => $this->city_id,
                'linkedin' => $this->linkedin,
                'instagram' => $this->instagram,
                'site' => $this->site,
                'cargo_atual' => $this->cargo_atual,
                'area_atuacao' => $this->area_atuacao,
                'areas_interesse' => $this->areas_interesse,
                'resumo_profissional' => $this->resumo_profissional,
                'mensagem' => $this->mensagem,
                'curriculo_arquivo' => $photoPath,
                'origem' => $this->origem,
                'status' => ResumeStatus::New, // Definindo o status como "novo"
                'lgpd_consentimento' => $this->lgpd_consentimento, // Definindo como verdadeiro
                'lgpd_consentimento_em' => now(), // Definindo a data atual
            ]);


            $this->reset();
            $this->showSuccessMessage = true;

            // Limpar mensagem de sucesso após 5 segundos
            $this->dispatch('clearSuccessMessage');
        } catch (\Exception $e) {
            dd($e);
            $this->showErrorMessage = true;
            $this->errorMessage = 'Erro ao registrar o associado. Tente novamente mais tarde.';
        }
    }

    public function updatedStateId($value): void
    {
        $this->city_id = '';

        if (empty($value)) {
            $this->cities = [];

            return;
        }

        $this->cities = City::query()
            ->where('state_id', $value)
            ->orderBy('title')
            ->get();

        $this->city_id = $this->cities->isNotEmpty() ? (string) $this->cities->first()->id : '';
    }

    public function clearSuccessMessage()
    {
        $this->showSuccessMessage = false;
    }

    public function resetForm()
    {
        $this->reset();
        $this->cities = [];
        $this->showSuccessMessage = false;
        $this->showErrorMessage = false;
        $this->errorMessage = '';
    }

    public function render()
    {
        return view('livewire.resume-register');
    }
}
