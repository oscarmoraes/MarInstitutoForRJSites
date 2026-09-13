<?php

namespace App\Livewire;

use Livewire\Mechanisms\HandleRequests\HandleRequests as BaseHandleRequests;

class HandleRequests extends BaseHandleRequests
{
    public function getUpdateUri()
    {
        return url('livewire/update');
    }
}
