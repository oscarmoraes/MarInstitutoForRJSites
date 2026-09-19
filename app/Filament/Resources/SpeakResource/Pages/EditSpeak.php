<?php

namespace App\Filament\Resources\SpeakResource\Pages;

use App\Filament\Resources\SpeakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpeak extends EditRecord
{
    protected static string $resource = SpeakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
