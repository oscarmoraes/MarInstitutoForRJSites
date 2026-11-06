<?php

namespace App\Filament\Resources\EventRegistrationResource\Pages;

use App\Filament\Resources\EventRegistrationResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEventRegistrations extends ListRecords
{
    protected static string $resource = EventRegistrationResource::class;

    public ?int $eventId = null;

    public function mount(): void
    {
        parent::mount();

        $eventId = request()->query('event');

        if ($eventId !== null) {
            $this->eventId = (int) Event::query()->findOrFail($eventId)->getKey();
        }
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($this->eventId !== null) {
            $query?->where('event_id', $this->eventId);
        }

        return $query;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
