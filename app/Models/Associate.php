<?php

namespace App\Models;

use App\Enums\AssociateStatus;
use App\Observers\AssociateObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(AssociateObserver::class)]
class Associate extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'uuid',
        'full_name',
        'cpf',
        'oab_number',
        'oab_state_id',
        'birth_date',
        'email',
        'phone_primary',
        'phone_secondary',
        'phone_office',
        'photo_path',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state_id',
        'city_id',
        'cep',
        'status',
        'registration_ip',
        'user_agent',
        'lgpd_acceptance',
        'lgpd_acceptance_date',
        'approved_by',
        'approved_at',
        'last_login_at',
        'notes'
    ];

    public function getPhonePrimaryFormattedAttribute()
    {
        return $this->formatPhoneNumber($this->phone_primary);
    }

    protected $casts = [
        'status' => AssociateStatus::class,
        'birth_date' => 'date',
        'lgpd_acceptance' => 'boolean',
        'lgpd_acceptance_date' => 'datetime',
        'approved_at' => 'datetime',
        'last_login_at' => 'datetime'
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function oabState()
    {
        return $this->belongsTo(State::class, 'oab_state_id');
    }

    private function formatPhoneNumber($number)
    {
        $number = preg_replace('/\D/', '', $number);

        if (strlen($number) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $number);
        } elseif (strlen($number) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $number);
        }

        return $number;
    }

    /**
     * <?php
        // No modelo
        $associate->status = AssociateStatus::Active;

        // Acessar valor
        $associate->status->value; // 'active'

        // Obter rótulo
        $associate->status->label(); // 'Ativo'

        // Obter cor
        $associate->status->color(); // 'success'

        // Verificar tipo
        if ($associate->status === AssociateStatus::Active) {
            // ...
        }

        // Em queries
        Associate::where('status', AssociateStatus::Active)->get();

        // Listar todos
        AssociateStatus::all(); // ['pending', 'active', 'inactive', 'blocked']
     */
}
