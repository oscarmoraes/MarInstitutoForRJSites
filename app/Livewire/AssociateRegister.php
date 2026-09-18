<?php

namespace App\Livewire;

use App\Enums\AssociateStatus;
use App\Models\Associate;
use App\Models\AssociateAdress;
use App\Models\City;
use App\Models\State;
use Faker\Provider\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AssociateRegister extends Component
{
    use WithFileUploads;

    public $full_name = '';
    public $cpf = '';
    public $oab_number = '';
    public $oab_state_id = '';
    public $birth_date = '';
    public $email = '';
    public $phone_primary = '';
    public $phone_secondary = '';
    public $phone_office = '';
    public $photo_path;
    public $lgpd_acceptance = false;

    public $cep = '';
    public $street = '';
    public $neighborhood = '';
    public $city_id = '';
    public $state_id = '';
    public $number = '';
    public $complement = '';
    
    public $states = [];
    public  $cities = [];

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
            'full_name' => 'required|string|max:255',
            'cpf' => 'required|string',
            'oab_number' => 'required|string|max:20',
            'oab_state_id' => 'required|exists:states,id',
            'birth_date' => 'required|date|before:today',
            'email' => 'nullable|email|unique:associates,email',
            'phone_primary' => 'required|string',
            'phone_secondary' => 'nullable|string',
            'photo_path' => 'required|image|max:10240',
            'lgpd_acceptance' => 'required',
        ];
    }

    protected $messages = [
        'full_name.required' => 'O nome completo é obrigatório.',
        'cpf.required' => 'O CPF é obrigatório.',
        'cpf.unique' => 'Este CPF já está cadastrado.',
        'oab_number.required' => 'O número OAB é obrigatório.',
        'oab_state_id.required' => 'O estado da OAB é obrigatório.',
        'oab_state_id.exists' => 'O estado da OAB não é válido.',
        'birth_date.required' => 'A data de nascimento é obrigatória.',
        'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
        'email.email' => 'Email deve ser um endereço de email válido.',
        'email.unique' => 'Este email já está cadastrado.',
        'phone_primary.required' => 'O telefone principal é obrigatório.',
        'phone_primary.regex' => 'O telefone deve estar no formato (XX) 9XXXX-XXXX ou (XX) XXXX-XXXX.',
        'phone_secondary.regex' => 'O telefone deve estar no formato (XX) 9XXXX-XXXX ou (XX) XXXX-XXXX.',
        'photo_path.required' => 'A foto é obrigatória.',
        'photo_path.image' => 'O arquivo deve ser uma imagem.',
        'photo_path.max' => 'A imagem não pode exceder 10MB.',
        'lgpd_acceptance.required' => 'Você deve aceitar os termos de LGPD.',
    ];

    public function save()
    {
        $this->validate();

        try {
            $photoPath = $this->photo_path->store('associates');

            $associate = Associate::create([
                'uuid' => Str::uuid(),
                'full_name' => $this->full_name,
                'cpf' => preg_replace('/\D/', '', $this->cpf),
                'oab_number' => $this->oab_number,
                'oab_state_id' => $this->oab_state_id,
                'birth_date' => $this->birth_date,
                'email' => $this->email,
                'phone_primary' => preg_replace('/\D/', '', $this->phone_primary),
                'phone_secondary' => $this->phone_secondary ? preg_replace('/\D/', '', $this->phone_secondary) : null,
                'phone_office' => $this->phone_office ? preg_replace('/\D/', '', $this->phone_office) : null,
                'photo_path' => $photoPath,
                'cep' => preg_replace('/\D/', '', $this->cep),
                'street' => $this->street,
                'number' => $this->number,
                'complement' => $this->complement,
                'district' => $this->neighborhood,
                'city_id' => $this->city_id,
                'state_id' => $this->state_id,
                'status' => AssociateStatus::Pending,
                'lgpd_acceptance' => true,
                'lgpd_acceptance_date' => now(),
                'registration_ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // AssociateAdress::create([
            //     'associate_id' => $associate->id,
            //     'cep' => preg_replace('/\D/', '', $this->cep),
            //     'street' => $this->street,
            //     'number' => $this->number,
            //     'complement' => $this->complement,
            //     'district' => $this->neighborhood,
            //     'city' => $this->city,
            //     'state' => $this->state,
            //     'is_office' => false,
            // ]);

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

    public function searchCep()
    {
        $cep = preg_replace('/\D/', '', $this->cep);

        if (strlen($cep) === 8) {
            $response = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");

            if ($response) {
                $data = json_decode($response, true);

                if (!isset($data['erro'])) {

                    $stateFind = State::query()
                        ->where('letter', strtoupper($data['uf'] ?? ''))
                        ->first();

                    $this->cities = City::query()
                        ->where('state_id', $stateFind->id ?? null)
                        ->get();

                    $cityFind = $stateFind
                        ? City::query()
                            ->where('state_id', $stateFind->id)
                            ->where('title', $data['localidade'] ?? '')
                            ->first()
                        : null;
                    
                    $this->street = $data['logradouro'] ?? '';
                    $this->neighborhood = $data['bairro'] ?? '';
                    $this->city_id = $cityFind ? $cityFind->id : '';
                    $this->state_id = $stateFind ? $stateFind->id : '';
                } else {
                    $this->showErrorMessage = true;
                    $this->errorMessage = 'CEP não encontrado.';
                }
            } else {
                $this->showErrorMessage = true;
                $this->errorMessage = 'Erro ao consultar o CEP. Tente novamente.';
            }
        } else {
            $this->showErrorMessage = true;
            $this->errorMessage = 'CEP deve conter 8 dígitos.';
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
        return view('livewire.associate-register');
    }
}
