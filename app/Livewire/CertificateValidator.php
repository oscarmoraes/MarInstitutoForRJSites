<?php

namespace App\Livewire;

use App\Models\Certificate;
use Livewire\Component;

class CertificateValidator extends Component
{
    public $codigo = '';

    public $searched = false;

    public $certificate = null;

    protected $rules = [
        'codigo' => 'required|min:4',
    ];

    public function mount($codigo = '')
    {
        if ($codigo) {
            $this->codigo = $codigo;
            $this->validateCertificate();
        }
    }

    public function validateCertificate()
    {
        $this->validate();

        $this->certificate = Certificate::where('codigo', trim($this->codigo))
            ->orWhere('hash_digital', trim($this->codigo))
            ->first();

        $this->searched = true;
    }

    public function resetSearch()
    {
        $this->reset(['codigo', 'searched', 'certificate']);
    }

    public function render()
    {
        return view('livewire.certificate-validator');
    }
}
