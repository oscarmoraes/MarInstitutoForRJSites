<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Atendimento';

    protected static ?string $modelLabel = 'Mensagem de Contato';

    protected static ?string $pluralModelLabel = 'Mensagens de Contato';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalhes da Mensagem')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome do Remetente')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefone / WhatsApp')
                            ->disabled(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Assunto / Departamento')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->label('Status do Atendimento')
                            ->options([
                                'NOVA' => 'Nova (Pendente)',
                                'LIDA' => 'Lida',
                                'RESPONDIDA' => 'Respondida',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\Textarea::make('message')
                            ->label('Mensagem Completa')
                            ->rows(6)
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data/Hora')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Assunto')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'NOVA' => 'warning',
                        'LIDA' => 'info',
                        'RESPONDIDA' => 'success',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'NOVA' => 'Nova',
                        'LIDA' => 'Lida',
                        'RESPONDIDA' => 'Respondida',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
