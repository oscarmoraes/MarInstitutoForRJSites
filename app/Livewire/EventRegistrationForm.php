<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventRegistration;
use Livewire\Component;

class EventRegistrationForm extends Component
{
    public $eventId;

    public $event;

    public $nome = '';

    public $email = '';

    public $oab_uf = '';

    public $whatsapp = '';

    public $submitted = false;

    public $codigoInscricao = '';

    protected $rules = [
        'nome' => 'required|min:3',
        'email' => 'required|email',
        'oab_uf' => 'required',
        'whatsapp' => 'required',
    ];

    public function mount($eventId = null)
    {
        $this->eventId = $eventId;
        if ($eventId) {
            $this->event = Event::find($eventId);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validated = $this->validate();

        $registration = EventRegistration::create([
            'event_id' => $this->eventId,
            'nome' => $this->nome,
            'email' => $this->email,
            'oab_uf' => $this->oab_uf,
            'whatsapp' => $this->whatsapp,
            'status' => 'CONFIRMADA',
        ]);

        $this->codigoInscricao = 'INS-'.str_pad($registration->id, 6, '0', STR_PAD_LEFT);
        $this->submitted = true;
    }

    public function resetForm()
    {
        $this->reset(['nome', 'email', 'oab_uf', 'whatsapp', 'submitted', 'codigoInscricao']);
    }

    public function render()
    {
        return view('livewire.event-registration-form');
    }
}
