<?php

namespace App\Filament\Resources;

use App\Enums\AssociateStatus;
use App\Filament\Resources\AssociateResource\Pages;
use App\Filament\Resources\AssociateResource\RelationManagers;
use App\Models\Associate;
use App\Models\City;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

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
                Forms\Components\Section::make('Dados pessoais')
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
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Dados profissionais')
                    ->schema([
                        Forms\Components\TextInput::make('oab_number')
                            ->label('Nº OAB')
                            ->maxLength(20),
                        Forms\Components\TextInput::make('oab_uf')
                            ->label('UF OAB')
                            ->maxLength(2),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('cep')
                            ->label('CEP')
                            ->mask('99999-999')
                            ->live(debounce: 500)
                            ->afterStateUpdated(fn (?string $state, Set $set) => static::fillAddressFromCep($state, $set))
                            ->maxLength(9),
                        Forms\Components\TextInput::make('street')
                            ->label('Logradouro')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('number')
                            ->label('Número')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('complement')
                            ->label('Complemento')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('neighborhood')
                            ->label('Bairro')
                            ->maxLength(255),
                        Forms\Components\Select::make('state_id')
                            ->label('Estado')
                            ->relationship('state', 'letter')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('city_id')
                            ->label('Cidade')
                            ->relationship('city', 'title')
                            ->searchable()
                            ->preload(),
                        
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Situação da associação')
                    ->schema([
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
                            ->label('Observações')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    protected static function fillAddressFromCep(?string $cep, Set $set): void
    {
        $cep = preg_replace('/\D/', '', $cep ?? '');

        if (strlen($cep) !== 8) {
            return;
        }

        try {
            $response = Http::acceptJson()
                ->timeout(5)
                ->get("https://viacep.com.br/ws/{$cep}/json/");
        } catch (\Throwable) {
            Notification::make()
                ->title('Não foi possível consultar o CEP')
                ->body('Verifique sua conexão e tente novamente.')
                ->danger()
                ->send();

            return;
        }

        if ($response->status() === 400 || ! $response->successful()) {
            Notification::make()
                ->title('CEP inválido')
                ->body('Informe um CEP com 8 dígitos.')
                ->warning()
                ->send();

            return;
        }

        $address = $response->json();

        if (($address['erro'] ?? false) === true) {
            Notification::make()
                ->title('CEP não encontrado')
                ->body('Confira o número informado e tente novamente.')
                ->warning()
                ->send();

            return;
        }

        $state = State::query()
            ->where('letter', strtoupper($address['uf'] ?? ''))
            ->first();

        $city = $state
            ? City::query()
                ->where('state_id', $state->id)
                ->where('title', $address['localidade'] ?? '')
                ->first()
            : null;

        $set('street', $address['logradouro'] ?? null);
        $set('complement', $address['complemento'] ?? null);
        $set('neighborhood', $address['bairro'] ?? null);
        $set('state_id', $state?->id);
        $set('city_id', $city?->id);
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
