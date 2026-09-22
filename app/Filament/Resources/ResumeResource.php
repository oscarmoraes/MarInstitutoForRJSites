<?php

namespace App\Filament\Resources;

use App\Enums\ResumeStatus;
use App\Filament\Resources\ResumeResource\Pages;
use App\Filament\Resources\ResumeResource\RelationManagers;
use App\Models\Resume;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Currículo';

    protected static ?string $pluralModelLabel = 'Currículos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->label('Nome do Candidato')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->label('Telefone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone_contato')
                    ->label('Telefone de Contato')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state_id')
                    ->label('Estado')
                    ->numeric(),
                Forms\Components\TextInput::make('city_id')
                    ->label('Cidade')
                    ->numeric(),
                Forms\Components\TextInput::make('linkedin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255),
                Forms\Components\TextInput::make('site')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cargo_atual')
                    ->maxLength(255),
                Forms\Components\TextInput::make('area_atuacao')
                    ->maxLength(255),
                Forms\Components\Textarea::make('areas_interesse')
                    ->label('Áreas de Interesse')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('resumo_profissional')
                    ->label('Resumo Profissional')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('mensagem')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('curriculo_arquivo')
                    ->label('Currículo')
                    ->directory('curriculos')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
                Forms\Components\TextInput::make('origem')
                    ->required()
                    ->maxLength(255)
                    ->default('site'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('novo'),
                Forms\Components\Toggle::make('lgpd_consentimento')
                    ->required(),
                Forms\Components\DateTimePicker::make('lgpd_consentimento_em'),
                Forms\Components\TextInput::make('politica_privacidade_versao')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.letter')
                    ->label('Estado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => ResumeStatus::New->value,
                        'success' => ResumeStatus::InAnalysis->value,
                        'gray' => ResumeStatus::Contacted->value,
                        'danger' => ResumeStatus::Archived->value,
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResumes::route('/'),
            'create' => Pages\CreateResume::route('/create'),
            'edit' => Pages\EditResume::route('/{record}/edit'),
        ];
    }
}
