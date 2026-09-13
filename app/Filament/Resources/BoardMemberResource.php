<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardMemberResource\Pages;
use App\Models\BoardMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BoardMemberResource extends Resource
{
    protected static ?string $model = BoardMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Gestão Institucional';

    protected static ?string $modelLabel = 'Diretor / Representante';

    protected static ?string $pluralModelLabel = 'Diretoria & Representantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->label('Nome Completo')
                    ->required(),
                Forms\Components\TextInput::make('cargo')
                    ->label('Cargo (Ex: Presidente Nacional, Representante SP)')
                    ->required(),
                Forms\Components\TextInput::make('oab')
                    ->label('Nº OAB'),
                Forms\Components\TextInput::make('uf')
                    ->label('UF Representada'),
                Forms\Components\Select::make('tipo')
                    ->label('Tipo de Função')
                    ->options([
                        'DIRETORIA' => 'DIRETORIA EXECUTIVA',
                        'COMISSAO' => 'COMISSÃO TEMÁTICA',
                        'REPRESENTANTE' => 'REPRESENTANTE UF',
                        'HONORARIO' => 'MEMBRO HONORÁRIO',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('ordem')
                    ->label('Ordem de Exibição')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('foto_url')
                    ->label('URL da Foto'),
                Forms\Components\Textarea::make('bio')
                    ->label('Mini Biografia / Histórico')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto_url')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl('https://ui-avatars.com/api/?name=MAR&background=17344D&color=fff'),
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cargo')
                    ->label('Cargo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('uf')
                    ->label('UF')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DIRETORIA' => 'danger',
                        'COMISSAO' => 'info',
                        'REPRESENTANTE' => 'primary',
                        'HONORARIO' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('ordem')
                    ->label('Ordem')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'DIRETORIA' => 'Diretoria Executiva',
                        'COMISSAO' => 'Comissão Temática',
                        'REPRESENTANTE' => 'Representante UF',
                        'HONORARIO' => 'Membro Honorário',
                    ]),
                Tables\Filters\SelectFilter::make('uf')
                    ->label('Filtrar por UF'),
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
            'index' => Pages\ListBoardMembers::route('/'),
            'create' => Pages\CreateBoardMember::route('/create'),
            'edit' => Pages\EditBoardMember::route('/{record}/edit'),
        ];
    }
}
