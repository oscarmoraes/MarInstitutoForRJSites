<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Models\Certificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Cursos & Eventos';

    protected static ?string $modelLabel = 'Certificado Oficial';

    protected static ?string $pluralModelLabel = 'Certificados Emitidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->label('Código de Autenticidade')
                    ->default('MAR-'.date('Y').'-'.rand(10000, 99999))
                    ->required(),
                Forms\Components\TextInput::make('participante_nome')
                    ->label('Nome do Participante')
                    ->required(),
                Forms\Components\TextInput::make('oab_uf')
                    ->label('OAB/UF'),
                Forms\Components\TextInput::make('evento_titulo')
                    ->label('Título do Simpósio / Curso')
                    ->required(),
                Forms\Components\TextInput::make('carga_horaria')
                    ->label('Carga Horária')
                    ->default('10 Horas Acadêmicas')
                    ->required(),
                Forms\Components\DatePicker::make('data_emissao')
                    ->label('Data de Emissão')
                    ->default(now())
                    ->required(),
                Forms\Components\TextInput::make('hash_digital')
                    ->label('Hash Digital de Validação')
                    ->default(fn () => md5(uniqid()))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('participante_nome')
                    ->label('Participante')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('oab_uf')
                    ->label('OAB/UF'),
                Tables\Columns\TextColumn::make('evento_titulo')
                    ->label('Simpósio / Curso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('carga_horaria')
                    ->label('Carga Horária'),
                Tables\Columns\TextColumn::make('data_emissao')
                    ->label('Emissão')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
