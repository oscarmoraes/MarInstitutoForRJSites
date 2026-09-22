<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventRegistrationResource\Pages;
use App\Models\EventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventRegistrationResource extends Resource
{
    protected static ?string $model = EventRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Eventos';

    protected static ?string $modelLabel = 'Inscritos';

    protected static ?string $pluralModelLabel = 'Inscritos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->label('Evento')
                    ->relationship('event', 'titulo')
                    ->required(),
                Forms\Components\TextInput::make('nome')
                    ->label('Nome do Participante')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email(),
                Forms\Components\TextInput::make('oab_uf')
                    ->label('OAB/UF'),
                Forms\Components\TextInput::make('whatsapp')
                    ->label('WhatsApp / Telefone')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status da Inscrição')
                    ->options([
                        'confirmado' => 'CONFIRMADO',
                        'pendente' => 'PENDENTE',
                        'cancelado' => 'CANCELADO',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.titulo')
                    ->label('Evento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('oab_uf')
                    ->label('OAB/UF')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmado' => 'success',
                        'pendente' => 'warning',
                        'cancelado' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data Inscrição')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'confirmado' => 'Confirmado',
                        'pendente' => 'Pendente',
                        'cancelado' => 'Cancelado',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventRegistrations::route('/'),
            'create' => Pages\CreateEventRegistration::route('/create'),
            'edit' => Pages\EditEventRegistration::route('/{record}/edit'),
        ];
    }
}
