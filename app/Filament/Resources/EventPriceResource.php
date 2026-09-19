<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventPriceResource\Pages;
use App\Filament\Resources\EventPriceResource\RelationManagers;
use App\Models\EventPrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventPriceResource extends Resource
{
    protected static ?string $model = EventPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Eventos';

    protected static ?string $modelLabel = 'Preço do Evento';

    protected static ?string $pluralModelLabel = 'Preços do Evento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->relationship('event', 'id')
                    ->required(),
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descricao')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\DateTimePicker::make('inicio'),
                Forms\Components\DateTimePicker::make('fim'),
                Forms\Components\TextInput::make('vagas')
                    ->numeric(),
                Forms\Components\Toggle::make('ativo')
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
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inicio')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fim')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vagas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('ativo')
                    ->boolean(),
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
            'index' => Pages\ListEventPrices::route('/'),
            'create' => Pages\CreateEventPrice::route('/create'),
            'edit' => Pages\EditEventPrice::route('/{record}/edit'),
        ];
    }
}
