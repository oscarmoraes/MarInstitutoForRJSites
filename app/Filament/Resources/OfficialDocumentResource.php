<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficialDocumentResource\Pages;
use App\Models\OfficialDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficialDocumentResource extends Resource
{
    protected static ?string $model = OfficialDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Gestão Institucional';

    protected static ?string $modelLabel = 'Ato Oficial / Resolução';

    protected static ?string $pluralModelLabel = 'Atos & Notas Oficiais';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero')
                    ->label('Número do Documento (Ex: Nota Oficial Nº 04/2026)')
                    ->required(),
                Forms\Components\TextInput::make('titulo')
                    ->label('Título do Documento')
                    ->required(),
                Forms\Components\DatePicker::make('data_publicacao')
                    ->label('Data de Publicação')
                    ->default(now())
                    ->required(),
                Forms\Components\Select::make('categoria')
                    ->label('Categoria')
                    ->options([
                        'NOTA_OFICIAL' => 'NOTA OFICIAL',
                        'RESOLUCAO' => 'RESOLUÇÃO',
                        'PORTARIA' => 'PORTARIA',
                        'MANIFESTO' => 'MANIFESTO',
                        'ATO_INSTITUCIONAL' => 'ATO INSTITUCIONAL',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('resumo')
                    ->label('Resumo Explicativo')
                    ->rows(3),
                Forms\Components\TextInput::make('arquivo_url')
                    ->label('URL / Caminho do PDF'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero')
                    ->label('Número')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('categoria')
                    ->label('Categoria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'NOTA_OFICIAL', 'MANIFESTO' => 'danger',
                        'RESOLUCAO' => 'info',
                        'PORTARIA', 'ATO_INSTITUCIONAL' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('data_publicacao')
                    ->label('Data Publicação')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria')
                    ->options([
                        'NOTA_OFICIAL' => 'Nota Oficial',
                        'RESOLUCAO' => 'Resolução',
                        'PORTARIA' => 'Portaria',
                        'MANIFESTO' => 'Manifesto',
                        'ATO_INSTITUCIONAL' => 'Ato Institucional',
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
            'index' => Pages\ListOfficialDocuments::route('/'),
            'create' => Pages\CreateOfficialDocument::route('/create'),
            'edit' => Pages\EditOfficialDocument::route('/{record}/edit'),
        ];
    }
}
