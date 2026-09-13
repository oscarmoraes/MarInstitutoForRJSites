<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Configurações';

    protected static ?string $navigationLabel = 'Configurações do Portal';

    protected static ?string $modelLabel = 'Configuração do Portal';

    protected static ?string $pluralModelLabel = 'Configurações do Portal';

    protected static ?int $navigationSort = 99;

    public static function canCreate(): bool
    {
        return SiteSetting::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Configurações do Sistema')
                    ->columnSpanFull()
                    ->tabs([
                        // ABA 1: IDENTIDADE & LOGO
                        Tab::make('Identidade & Logo')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('site_name')
                                        ->label('Nome da Instituição')
                                        ->required()
                                        ->default('Instituto MAR'),

                                    TextInput::make('site_tagline')
                                        ->label('Slogan / Tagline Institucional')
                                        ->default('Movimento da Advocacia Renovada'),
                                ]),

                                Section::make('Logotipo Oficial')
                                    ->description('Envie a imagem da logo do portal ou mantenha a padrão em assets.')
                                    ->schema([
                                        FileUpload::make('logo_url')
                                            ->label('Logotipo do Portal')
                                            ->image()
                                            ->directory('settings')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->helperText('Formato ideal: PNG transparente ou SVG.'),
                                    ]),
                            ]),

                        // ABA 2: REDES & CONTATOS
                        Tab::make('Redes & Contatos')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                Section::make('Canais de Atendimento Direto')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('email_contato')
                                                ->label('E-mail Geral de Atendimento')
                                                ->email()
                                                ->required(),

                                            TextInput::make('telefone_plantao')
                                                ->label('Telefone / Hotline Plantão')
                                                ->required(),

                                            TextInput::make('whatsapp_plantao')
                                                ->label('WhatsApp Plantão')
                                                ->required(),
                                        ]),

                                        Grid::make(2)->schema([
                                            TextInput::make('endereco_sede_df')
                                                ->label('Endereço Sede Brasília (DF)')
                                                ->columnSpan(1),

                                            TextInput::make('endereco_sede_sp')
                                                ->label('Endereço Sede São Paulo (SP)')
                                                ->columnSpan(1),
                                        ]),
                                    ]),

                                Section::make('Redes Sociais Oficiais')
                                    ->description('Os links preenchidos aparecerão automaticamente nos ícones do rodapé.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('instagram_url')
                                                ->label('Instagram')
                                                ->url()
                                                ->placeholder('https://instagram.com/institutomardireito'),

                                            TextInput::make('linkedin_url')
                                                ->label('LinkedIn')
                                                ->url()
                                                ->placeholder('https://linkedin.com/company/institutomardireito'),

                                            TextInput::make('youtube_url')
                                                ->label('YouTube')
                                                ->url()
                                                ->placeholder('https://youtube.com/@institutomardireito'),
                                        ]),

                                        Grid::make(2)->schema([
                                            TextInput::make('twitter_url')
                                                ->label('X (Twitter)')
                                                ->url()
                                                ->placeholder('https://x.com/institutomardireito'),

                                            TextInput::make('facebook_url')
                                                ->label('Facebook')
                                                ->url()
                                                ->placeholder('https://facebook.com/institutomardireito'),
                                        ]),
                                    ]),
                            ]),

                        // ABA 3: RÓTULOS DO MENU
                        Tab::make('Nomes do Menu')
                            ->icon('heroicon-o-bars-3')
                            ->schema([
                                Section::make('Personalização dos Textos do Menu')
                                    ->description('Altere o nome exibido para cada seção na barra de navegação.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('menu_inicio')
                                                ->label('Item: Início')
                                                ->required(),

                                            TextInput::make('menu_institucional')
                                                ->label('Dropdown: Institucional')
                                                ->required(),

                                            TextInput::make('menu_diretoria')
                                                ->label('Item: Diretoria')
                                                ->required(),
                                        ]),

                                        Grid::make(3)->schema([
                                            TextInput::make('menu_representantes')
                                                ->label('Item: Representantes')
                                                ->required(),

                                            TextInput::make('menu_honorarios')
                                                ->label('Item: Honorários')
                                                ->required(),

                                            TextInput::make('menu_conteudo')
                                                ->label('Dropdown: Conteúdo')
                                                ->required(),
                                        ]),

                                        Grid::make(3)->schema([
                                            TextInput::make('menu_noticias')
                                                ->label('Item: Notícias')
                                                ->required(),

                                            TextInput::make('menu_atos')
                                                ->label('Item: Atos Oficiais')
                                                ->required(),

                                            TextInput::make('menu_cursos')
                                                ->label('Item: Cursos e Palestras')
                                                ->required(),
                                        ]),

                                        Grid::make(4)->schema([
                                            TextInput::make('menu_validar_cert')
                                                ->label('Item: Validar Certificado')
                                                ->required(),

                                            TextInput::make('menu_prerrogativas')
                                                ->label('Item: Prerrogativas 24h')
                                                ->required(),

                                            TextInput::make('menu_contato')
                                                ->label('Item: Contato')
                                                ->required(),

                                            TextInput::make('menu_carteirinha')
                                                ->label('Botão: Carteirinha')
                                                ->required(),
                                        ]),

                                        TextInput::make('menu_associar')
                                            ->label('Botão Principal: Seja um Associado')
                                            ->required(),
                                    ]),
                            ]),

                        // ABA 4: MÓDULOS DO PROJETO (TOGGLES)
                        Tab::make('Módulos do Projeto')
                            ->icon('heroicon-o-squares-plus')
                            ->schema([
                                Section::make('Ativar / Desativar Módulos Funcionais')
                                    ->description('Ao desativar um módulo, ele será ocultado automaticamente de todos os menus e seções públicas da Home.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Toggle::make('modulo_noticias')
                                                ->label('Módulo: Notícias e Portal')
                                                ->helperText('Controla a exibição do portal de notícias.')
                                                ->default(true),

                                            Toggle::make('modulo_cursos')
                                                ->label('Módulo: Cursos e Eventos')
                                                ->helperText('Controla a exibição de cursos, simpósios e agenda.')
                                                ->default(true),

                                            Toggle::make('modulo_atos_oficiais')
                                                ->label('Módulo: Notas e Atos Oficiais')
                                                ->helperText('Controla a exibição de atos e transparência.')
                                                ->default(true),

                                            Toggle::make('modulo_prerrogativas')
                                                ->label('Módulo: Plantão de Prerrogativas 24h')
                                                ->helperText('Controla o canal de denúncias e hotline 24h.')
                                                ->default(true),

                                            Toggle::make('modulo_associacao')
                                                ->label('Módulo: Associação MAR')
                                                ->helperText('Controla os botões e o formulário de associação.')
                                                ->default(true),

                                            Toggle::make('modulo_carteirinha')
                                                ->label('Módulo: Carteirinha Digital')
                                                ->helperText('Controla o acesso à credencial digital de membros.')
                                                ->default(true),

                                            Toggle::make('modulo_certificados')
                                                ->label('Módulo: Validação de Certificados')
                                                ->helperText('Controla a página pública de autenticidade.')
                                                ->default(true),

                                            Toggle::make('modulo_representantes')
                                                ->label('Módulo: Representantes Regionais')
                                                ->helperText('Controla a página e mapa de representantes nos estados.')
                                                ->default(true),

                                            Toggle::make('modulo_diretoria')
                                                ->label('Módulo: Diretoria e Comissões')
                                                ->helperText('Controla a página de diretoria e comissões.')
                                                ->default(true),

                                            Toggle::make('modulo_honorarios')
                                                ->label('Módulo: Membros Honorários')
                                                ->helperText('Controla a galeria de membros honorários.')
                                                ->default(true),
                                        ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('Instituição')
                    ->weight('bold'),

                TextColumn::make('email_contato')
                    ->label('E-mail Principal'),

                TextColumn::make('telefone_plantao')
                    ->label('Telefone'),

                IconColumn::make('modulo_noticias')
                    ->label('Notícias')
                    ->boolean(),

                IconColumn::make('modulo_cursos')
                    ->label('Cursos')
                    ->boolean(),

                IconColumn::make('modulo_prerrogativas')
                    ->label('Prerrogativas')
                    ->boolean(),

                IconColumn::make('modulo_carteirinha')
                    ->label('Carteirinha')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar Configurações'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
