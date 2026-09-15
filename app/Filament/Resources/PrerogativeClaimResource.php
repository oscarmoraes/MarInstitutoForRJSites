<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrerogativeClaimResource\Pages;
use App\Models\PrerogativeClaim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrerogativeClaimResource extends Resource
{
    protected static ?string $model = PrerogativeClaim::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationGroup = 'Atendimento Emergencial';

    protected static ?string $modelLabel = 'Ocorrência de Prerrogativa';

    protected static ?string $pluralModelLabel = 'Plantão 24h Prerrogativas';
    
    //preciso esconder esta pagina
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('protocolo')
                    ->label('Nº de Protocolo')
                    ->required(),
                Forms\Components\TextInput::make('adv_nome')
                    ->label('Advogado Requerente')
                    ->required(),
                Forms\Components\TextInput::make('adv_oab')
                    ->label('Nº OAB')
                    ->required(),
                Forms\Components\TextInput::make('adv_uf')
                    ->label('UF OAB')
                    ->required(),
                Forms\Components\TextInput::make('adv_email')
                    ->label('E-mail')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('adv_phone')
                    ->label('WhatsApp / Telefone 24h')
                    ->required(),
                Forms\Components\Select::make('tipo_violacao')
                    ->label('Tipo de Violação Principal')
                    ->options([
                        'Impedimento de Acesso aos Autos' => 'Impedimento de Acesso aos Autos',
                        'Desrespeito a Honorários Arbitrados' => 'Desrespeito a Honorários Arbitrados',
                        'Busca e Apreensão Ilegal em Escritório' => 'Busca e Apreensão Ilegal em Escritório',
                        'Prisão / Retenção no Exercício da Profissão' => 'Prisão / Retenção no Exercício da Profissão',
                        'Desrespeito à Urbanidade por Autoridade' => 'Desrespeito à Urbanidade por Autoridade',
                        'Outra Violação de Prerrogativa' => 'Outra Violação de Prerrogativa',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('orgao_local')
                    ->label('Órgão / Tribunal / Delegacia')
                    ->required(),
                Forms\Components\TextInput::make('autor_atentado')
                    ->label('Autor do Atentado (Nome/Cargo)'),
                Forms\Components\TextInput::make('processo_num')
                    ->label('Nº do Processo / Autos'),
                Forms\Components\Textarea::make('descricao_fatos')
                    ->label('Relato Detalhado dos Fatos')
                    ->rows(4)
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status do Atendimento')
                    ->options([
                        'RECEBIDO' => 'RECEBIDO',
                        'EM_ANALISE' => 'EM ANÁLISE',
                        'ATENDIDO' => 'ATENDIDO',
                        'CONCLUIDO' => 'CONCLUÍDO',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('protocolo')
                    ->label('Protocolo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adv_nome')
                    ->label('Advogado')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adv_oab')
                    ->label('OAB/UF')
                    ->formatStateUsing(fn ($record) => "{$record->adv_oab}/{$record->adv_uf}"),
                Tables\Columns\TextColumn::make('tipo_violacao')
                    ->label('Violação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orgao_local')
                    ->label('Órgão / Tribunal'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'RECEBIDO' => 'danger',
                        'EM_ANALISE' => 'warning',
                        'ATENDIDO' => 'info',
                        'CONCLUIDO' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data Acionamento')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'RECEBIDO' => 'Recebido',
                        'EM_ANALISE' => 'Em Análise',
                        'ATENDIDO' => 'Atendido',
                        'CONCLUIDO' => 'Concluído',
                    ]),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrerogativeClaims::route('/'),
            'create' => Pages\CreatePrerogativeClaim::route('/create'),
            'edit' => Pages\EditPrerogativeClaim::route('/{record}/edit'),
        ];
    }
}
