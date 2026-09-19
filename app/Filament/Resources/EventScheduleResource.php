<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventScheduleResource\Pages;
use App\Filament\Resources\EventScheduleResource\RelationManagers;
use App\Models\EventSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventScheduleResource extends Resource
{
    protected static ?string $model = EventSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Eventos';

    protected static ?string $modelLabel = 'Agenda do Evento';

    protected static ?string $pluralModelLabel = 'Agendas do Evento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->relationship('event', 'id')
                    ->required(),
                Forms\Components\Select::make('speaker_id')
                    ->relationship('speaker', 'id'),
                Forms\Components\TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descricao')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('inicio')
                    ->required(),
                Forms\Components\DateTimePicker::make('fim')
                    ->required(),
                Forms\Components\TextInput::make('ordem')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('speaker.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('inicio')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fim')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ordem')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventSchedules::route('/'),
            'create' => Pages\CreateEventSchedule::route('/create'),
            'edit' => Pages\EditEventSchedule::route('/{record}/edit'),
        ];
    }
}
