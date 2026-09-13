<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Limpa qualquer intended url prévia que possa estar dessincronizada no XAMPP
        session()->forget('url.intended');

        $targetUrl = Filament::getPanel('admin')->getUrl();

        return redirect()->to($targetUrl);
    }
}
