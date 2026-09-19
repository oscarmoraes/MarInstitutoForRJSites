<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Eventos';

    protected static ?string $modelLabel = 'Evento';

    protected static ?string $pluralModelLabel = 'Eventos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->label('Título do Evento')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug de URL')
                    ->required()
                    ->unique(Event::class, 'slug', ignoreRecord: true),
                Forms\Components\TextInput::make('subtitulo')
                    ->label('Subtítulo do Evento'),
                Forms\Components\DateTimePicker::make('data_evento')
                    ->label('Data e Horário do Evento')
                    ->required(),
                Forms\Components\DateTimePicker::make('inicio')
                    ->label('Início do Evento')
                    ->required(),
                Forms\Components\DateTimePicker::make('fim')
                    ->label('Fim do Evento')
                    ->required(),
                Forms\Components\Select::make('state_id')
                    ->label('Estado')
                    ->relationship('state', 'letter')
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->label('Cidade')
                    ->relationship('city', 'title')
                    ->required(),
                Forms\Components\TextInput::make('local')
                    ->label('Local / Transmissão')
                    ->required(),
                Forms\Components\TextInput::make('endereco')
                    ->label('Endereço do Evento'),
                Forms\Components\Toggle::make('exige_inscricao')
                    ->label('Exige Inscrição')
                    ->default(true),
                Forms\Components\DateTimePicker::make('inscricoes_inicio')
                    ->label('Início das Inscrições'),
                Forms\Components\DateTimePicker::make('inscricoes_fim')
                    ->label('Fim das Inscrições'),
                Forms\Components\TextInput::make('vagas_totais')
                    ->label('Vagas Totais')
                    ->numeric()
                    ->default(30)
                    ->required(),
                Forms\Components\Select::make('formato')
                    ->label('Formato')
                    ->options([
                        'Híbrido' => 'Híbrido (Presencial + On-line)',
                        'Presencial' => 'Presencial',
                        'On-line' => 'On-line HD',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('carga_horaria')
                    ->label('Carga Horária para Certificado')
                    ->default('10 Horas Acadêmicas'),
                Forms\Components\TextInput::make('carga_horaria_estudante')
                    ->label('Carga Horária para Certificado (Estudante)')
                    ->default('5 Horas Acadêmicas'),
                Forms\Components\Toggle::make('possui_certificado')
                    ->label('Possui Certificado')
                    ->default(false),
                Forms\Components\TextInput::make('resumo')
                    ->label('Resumo do Evento')
                    ->maxLength(255),
                Forms\Components\Textarea::make('descricao')
                    ->label('Descrição do Evento')
                    ->rows(4),
                Forms\Components\Toggle::make('ativo')
                    ->label('Publicado')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(45),
                Tables\Columns\TextColumn::make('data_evento')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('formato')
                    ->label('Formato')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Presencial' => 'danger',
                        'On-line' => 'info',
                        'Híbrido' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('vagas_totais')
                    ->label('Vagas'),
                Tables\Columns\TextColumn::make('registrations_count')
                    ->label('Inscritos')
                    ->counts('registrations')
                    ->badge()
                    ->color('success'),
                Tables\Columns\IconColumn::make('ativo')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('ativo')
                    ->label('Apenas Ativos'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
