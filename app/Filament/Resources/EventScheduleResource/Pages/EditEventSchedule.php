<?php

namespace App\Filament\Resources\EventScheduleResource\Pages;

use App\Filament\Resources\EventScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventSchedule extends EditRecord
{
    protected static string $resource = EventScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
