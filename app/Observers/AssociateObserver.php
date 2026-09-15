<?php

namespace App\Observers;

use App\Models\Associate;

class AssociateObserver
{
    public function creating(Associate $associate)
    {
        // Gerar UUID antes de criar o registro
        $associate->uuid = (string) \Illuminate\Support\Str::orderedUuid();
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
        //
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
