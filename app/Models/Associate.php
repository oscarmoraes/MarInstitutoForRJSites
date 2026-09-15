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
        'oab_uf',
        'birth_date',
        'email',
        'phone_primary',
        'phone_secondary',
        'photo_path',
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
