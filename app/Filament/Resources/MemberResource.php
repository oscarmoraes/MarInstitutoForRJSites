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
                // Forms\Components\TextInput::make('matricula')
                //     ->label('Matrícula MAR')
                //     ->required()
                //     ->default('#2026-'.rand(1000, 9999)),
                Forms\Components\TextInput::make('nome')
                    ->label('Nome')
                    ->required(),
                Forms\Components\TextInput::make('cpf')
                    ->label('CPF')
                    ->mask('999.999.999-99'),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('telefone')
                    ->label('WhatsApp / Telefone')
                    ->mask('(99) 99999-9999'),
                Forms\Components\TextInput::make('oab')
                    ->label('Nº OAB')
                    ->required(),
                // select box de state_id ja carregado sem serarch
                Forms\Components\Select::make('state_id')
                    ->label('UF Representada')
                    ->relationship('state', 'letter')
                    ->preload(),

                Forms\Components\TextInput::make('categoria')
                    ->label('Região')
                    ->hint('Ex: Baixada Fluminense, Região dos Lagos'),
                // Forms\Components\TextInput::make('comissao')
                //     ->label('Comissão Integrante'),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'ATIVO' => 'ATIVO',
                        'PENDENTE' => 'PENDENTE',
                        'SUSPENSO' => 'SUSPENSO',
                    ])
                    ->required(),
                // Forms\Components\DatePicker::make('validade')
                //     ->label('Validade da Anuidade')
                //     ->required(),
                Forms\Components\FileUpload::make('foto_url')
                    ->label('Foto de Perfil')
                    ->directory('members')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->image(),
                // Forms\Components\TextInput::make('hash_validacao')
                //     ->label('Código Hash de Validação'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('oab')
                    ->label('OAB')
                    ->formatStateUsing(fn ($record) => "{$record->oab}")
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.letter')
                    ->label('UF OAB')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria')
                    ->label('Região')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ATIVO' => 'success',
                        'PENDENTE' => 'warning',
                        'SUSPENSO' => 'danger',
                        default => 'gray',
                    }),
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
