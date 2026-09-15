<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Gestão Institucional';

    protected static ?string $modelLabel = 'Representantes';

    protected static ?string $pluralModelLabel = 'Representantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('matricula')
                    ->label('Matrícula MAR')
                    ->required()
                    ->default('#2026-'.rand(1000, 9999)),
                Forms\Components\TextInput::make('nome')
                    ->label('Nome Completo')
                    ->required(),
                Forms\Components\TextInput::make('cpf')
                    ->label('CPF'),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('telefone')
                    ->label('WhatsApp / Telefone'),
                Forms\Components\TextInput::make('oab')
                    ->label('Nº OAB')
                    ->required(),
                Forms\Components\TextInput::make('uf')
                    ->label('UF OAB')
                    ->required(),
                Forms\Components\Select::make('categoria')
                    ->label('Categoria de Associação')
                    ->options([
                        'Advogado Efetivo' => 'Advogado Efetivo',
                        'Membro Honorário' => 'Membro Honorário',
                        'Estudante / Acadêmico' => 'Estudante / Acadêmico',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('comissao')
                    ->label('Comissão Integrante'),
                Forms\Components\Select::make('status')
                    ->label('Status da Filiação')
                    ->options([
                        'ATIVO' => 'ATIVO',
                        'PENDENTE' => 'PENDENTE',
                        'SUSPENSO' => 'SUSPENSO',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('validade')
                    ->label('Validade da Anuidade')
                    ->required(),
                Forms\Components\TextInput::make('foto_url')
                    ->label('URL da Foto de Perfil'),
                Forms\Components\TextInput::make('hash_validacao')
                    ->label('Código Hash de Validação'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('oab')
                    ->label('OAB/UF')
                    ->formatStateUsing(fn ($record) => "{$record->oab}/{$record->uf}")
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria')
                    ->label('Categoria')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ATIVO' => 'success',
                        'PENDENTE' => 'warning',
                        'SUSPENSO' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('validade')
                    ->label('Validade')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'ATIVO' => 'Ativo',
                        'PENDENTE' => 'Pendente',
                        'SUSPENSO' => 'Suspenso',
                    ]),
                Tables\Filters\SelectFilter::make('categoria')
                    ->options([
                        'Advogado Efetivo' => 'Advogado Efetivo',
                        'Membro Honorário' => 'Membro Honorário',
                        'Estudante / Acadêmico' => 'Estudante / Acadêmico',
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
