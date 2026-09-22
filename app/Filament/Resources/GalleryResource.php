<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Event;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    // protected static ?string $navigationGroup = 'Eventos';

    protected static ?string $modelLabel = 'Galeria';

    protected static ?string $pluralModelLabel = 'Galerias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('galleryable_id')
                    ->label('Evento')
                    ->options(fn () => Event::query()->orderBy('titulo')->pluck('titulo', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Hidden::make('galleryable_type')
                    ->default(Event::class),
                Forms\Components\TextInput::make('title')
                    ->label('Título da Galeria')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicada',
                    ])
                    ->default('published')
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Publicar em')
                    ->default(now()),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('photos')
                    ->label('Fotos da Galeria')
                    ->relationship()
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->label('Imagem')
                            ->image()
                            ->disk('public')
                            ->directory('galleries')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Descrição')
                            ->rows(2),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2)
                    ->defaultItems(1)
                    ->addActionLabel('Adicionar foto')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Galeria')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('galleryable.titulo')
                    ->label('Evento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('photos_count')
                    ->label('Fotos')
                    ->counts('photos')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'published' ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publicação')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}