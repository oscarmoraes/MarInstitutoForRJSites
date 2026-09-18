<?php

namespace App\Observers;

use App\Models\Associate;

class AssociateObserver
{
    public function creating(Associate $associate)
    {
        // Gerar UUID antes de criar o registro
        $associate->uuid = (string) \Illuminate\Support\Str::orderedUuid();

        // limpar a formatacao dos telefones
        $associate->phone_primary = preg_replace('/\D/', '', $associate->phone_primary);
        $associate->phone_secondary = preg_replace('/\D/', '', $associate->phone_secondary);
        $associate->phone_office = preg_replace('/\D/', '', $associate->phone_office);
    }

    public function updating(Associate $associate)
    {
        // limpar a formatacao dos telefones
        $associate->phone_primary = preg_replace('/\D/', '', $associate->phone_primary);
        $associate->phone_secondary = preg_replace('/\D/', '', $associate->phone_secondary);
        $associate->phone_office = preg_replace('/\D/', '', $associate->phone_office);
    }

    /**
     * Handle the Associate "created" event.
     */
    public function created(Associate $associate): void
    {
        //
    }

    /**
     * Handle the Associate "updated" event.
     */
    public function updated(Associate $associate): void
    {
        
    }

    /**
     * Handle the Associate "deleted" event.
     */
    public function deleted(Associate $associate): void
    {
        //
    }

    /**
     * Handle the Associate "restored" event.
     */
    public function restored(Associate $associate): void
    {
        //
    }

    /**
     * Handle the Associate "force deleted" event.
     */
    public function forceDeleted(Associate $associate): void
    {
        //
    }
}
