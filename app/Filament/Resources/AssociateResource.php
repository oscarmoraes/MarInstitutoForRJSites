<?php

namespace App\Filament\Resources;

use App\Enums\AssociateStatus;
use App\Filament\Resources\AssociateResource\Pages;
use App\Filament\Resources\AssociateResource\RelationManagers;
use App\Models\Associate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssociateResource extends Resource
{
    protected static ?string $model = Associate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Associado';
    protected static ?string $pluralModelLabel = 'Associados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('Nome Completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cpf')
                    ->label('CPF')
                    ->mask('999.999.999-99')
                    ->required()
                    ->maxLength(14),
                Forms\Components\TextInput::make('oab_number')
                    ->label('Nº OAB')
                    ->maxLength(20),
                Forms\Components\TextInput::make('oab_uf')
                    ->label('UF OAB')
                    ->maxLength(2),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Data de Nascimento'),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_primary')
                    ->label('Telefone Principal')
                    ->tel()
                    ->mask('(99) 99999-9999')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('phone_secondary')
                    ->label('Telefone Secundário')
                    ->tel()
                    ->mask('(99) 99999-9999')
                    ->maxLength(20),
                Forms\Components\FileUpload::make('photo_path')
                    ->label('Foto do Perfil')
                    ->image()
                    ->directory('associates')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png']),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        AssociateStatus::Pending->value => AssociateStatus::Pending->label(),
                        AssociateStatus::Active->value => AssociateStatus::Active->label(),
                        AssociateStatus::Inactive->value => AssociateStatus::Inactive->label(),
                        AssociateStatus::Blocked->value => AssociateStatus::Blocked->label(),
                    ])
                    ->default(AssociateStatus::Pending->value)
                    ->required(),
                Forms\Components\Toggle::make('lgpd_acceptance')
                    ->label('Aceito a política de proteção de dados pessoais (LGPD)')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nome Completo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('oab_uf')
                    ->label('UF OAB')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_primary')
                    ->label('Telefone Principal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => AssociateStatus::Pending,
                        'success' => AssociateStatus::Active,
                        'gray' => AssociateStatus::Inactive,
                        'danger' => AssociateStatus::Blocked,
                    ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAssociates::route('/'),
            'create' => Pages\CreateAssociate::route('/create'),
            'edit' => Pages\EditAssociate::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
