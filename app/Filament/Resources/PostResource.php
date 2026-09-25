<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Imprensa & Conteúdo';

    protected static ?string $modelLabel = 'Notícia / Artigo';

    protected static ?string $pluralModelLabel = 'Notícias & Imprensa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->label('Título da Notícia')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug de URL')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Select::make('categoria')
                    ->label('Categoria')
                    ->options([
                        'INSTITUCIONAL' => 'Institucional',
                        'FORMAÇÃO' => 'Formação',
                        'REPRESENTATIVIDADE' => 'Representatividade',
                        'ATOS OFICIAIS' => 'Atos Oficiais',
                        'HONORARIOS' => 'Honorários',
                        'PRERROGATIVAS' => 'Prerrogativas',
                        'EVENTOS' => 'Eventos',
                        'JUSTIÇA' => 'Justiça',
                    ])
                    ->searchable()
                    ->required(),

                Forms\Components\FileUpload::make('imagem_capa')
                    ->label('Imagem de Capa')
                    ->directory('posts')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->image(),

                // Forms\Components\TextInput::make('imagem_capa')
                //     ->label('URL da Imagem de Capa')
                //     ->placeholder('https://images.unsplash.com/... ou URL da imagem'),

                Forms\Components\TextInput::make('autor')
                    ->label('Autor')
                    ->default('Assessoria de Imprensa MAR'),

                Forms\Components\TextInput::make('tempo_leitura')
                    ->label('Tempo de Leitura')
                    ->default('4 min'),

                Forms\Components\DatePicker::make('publicado_em')
                    ->label('Data de Publicação')
                    ->default(now())
                    ->required(),

                Forms\Components\Toggle::make('destaque')
                    ->label('Destaque Principal')
                    ->default(false),

                Forms\Components\Textarea::make('resumo')
                    ->label('Resumo da Matéria')
                    ->rows(3)
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('conteudo')
                    ->label('Conteúdo Completo')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('imagem_capa')
                    ->label('Capa')
                    ->square(),
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('categoria')
                    ->label('Categoria')
                    ->badge(),
                Tables\Columns\TextColumn::make('autor')
                    ->label('Autor')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('publicado_em')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('destaque')
                    ->label('Destaque')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria')
                    ->options([
                        'INSTITUCIONAL' => 'Institucional',
                        'FORMAÇÃO' => 'Formação',
                        'REPRESENTATIVIDADE' => 'Representatividade',
                        'ATOS OFICIAIS' => 'Atos Oficiais',
                        'HONORARIOS' => 'Honorários',
                        'PRERROGATIVAS' => 'Prerrogativas',
                        'EVENTOS' => 'Eventos',
                        'JUSTIÇA' => 'Justiça',
                    ]),
                Tables\Filters\TernaryFilter::make('destaque')
                    ->label('Destaque'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
