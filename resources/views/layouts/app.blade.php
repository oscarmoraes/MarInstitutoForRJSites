<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Instituto MAR — Movimento da Advocacia Renovada')</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts: Manrope & Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Custom CSS Tokens -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

  @livewireStyles
  @stack('styles')
</head>
<body class="bg-[#F4F6F8] text-[#252B30] flex flex-col min-h-screen font-body antialiased">
  @php
    $portalLogo = isset($siteSettings) && $siteSettings->logo_url 
      ? (str_starts_with($siteSettings->logo_url, 'http') || str_starts_with($siteSettings->logo_url, 'assets/') ? asset($siteSettings->logo_url) : asset('storage/' . $siteSettings->logo_url))
      : asset('assets/images/logo-mar.png');
    $portalName = $siteSettings->site_name ?? 'Instituto MAR';
    $portalTagline = $siteSettings->site_tagline ?? 'Movimento da Advocacia Renovada';
  @endphp

  <!-- HEADER INSTITUCIONAL STICKY -->
  <header class="site-header py-3 px-4 sm:px-6 lg:px-8 border-b border-slate-200">
    <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
      
      <!-- LOGO OFICIAL INSTITUTO MAR -->
      <a href="{{ route('home') }}" class="flex items-center shrink-0">
        <img src="{{ $portalLogo }}" alt="{{ $portalName }}" class="h-10 sm:h-12 w-auto object-contain">
      </a>

      <!-- MENU DESKTOP (SINGLE-LINE UNIFIED WITH SAFE HOVER BRIDGES) -->
      <nav class="hidden xl:flex items-center gap-7 text-sm font-medium text-slate-700 whitespace-nowrap">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#17344D] py-2 transition-colors' }}">{{ $siteSettings->menu_inicio ?? 'Início' }}</a>
        
        <!-- Dropdown Institucional -->
        @if(($siteSettings->modulo_diretoria ?? true) || ($siteSettings->modulo_representantes ?? true) || ($siteSettings->modulo_honorarios ?? true))
          <div class="nav-dropdown group">
            <button class="{{ request()->routeIs('diretoria', 'representantes', 'membros-honorarios') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : '' }} hover:text-[#17344D] py-2 flex items-center gap-1.5 focus:outline-none">
              {{ $siteSettings->menu_institucional ?? 'Institucional' }} <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:rotate-180 transition-transform"></i>
            </button>
            <div class="nav-dropdown-menu">
              <div class="w-60 bg-white border border-slate-200 rounded-xl shadow-xl py-2">
                @if($siteSettings->modulo_diretoria ?? true)
                  <a href="{{ route('diretoria') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-users text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_diretoria ?? 'Diretoria e Comissões' }}</a>
                @endif
                @if($siteSettings->modulo_representantes ?? true)
                  <a href="{{ route('representantes') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-map-location-dot text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_representantes ?? 'Representantes por Estado' }}</a>
                @endif
                @if($siteSettings->modulo_honorarios ?? true)
                  <a href="{{ route('membros-honorarios') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-award text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_honorarios ?? 'Membros Honorários' }}</a>
                @endif
              </div>
            </div>
          </div>
        @endif

        <!-- Dropdown Conteúdo -->
        <!-- @if(($siteSettings->modulo_noticias ?? true) || ($siteSettings->modulo_atos_oficiais ?? true) || ($siteSettings->modulo_cursos ?? true) || ($siteSettings->modulo_certificados ?? true))
          <div class="nav-dropdown group">
            <button class="{{ request()->routeIs('notas-oficiais') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : '' }} hover:text-[#17344D] py-2 flex items-center gap-1.5 focus:outline-none">
              {{ $siteSettings->menu_conteudo ?? 'Conteúdo' }} <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:rotate-180 transition-transform"></i>
            </button>
            <div class="nav-dropdown-menu">
              <div class="w-60 bg-white border border-slate-200 rounded-xl shadow-xl py-2">
                @if($siteSettings->modulo_noticias ?? true)
                  <a href="{{ route('noticias') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-newspaper text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_noticias ?? 'Notícias e Portal' }}</a>
                @endif
                @if($siteSettings->modulo_atos_oficiais ?? true)
                  <a href="{{ route('notas-oficiais') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-scroll text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_atos ?? 'Notas e Atos Oficiais' }}</a>
                @endif
                @if($siteSettings->modulo_cursos ?? true)
                  <a href="{{ route('cursos') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-graduation-cap text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_cursos ?? 'Cursos e Palestras' }}</a>
                @endif
                @if($siteSettings->modulo_certificados ?? true)
                  <a href="{{ route('certificados.validar') }}" class="block px-4 py-2.5 hover:bg-slate-50 text-slate-700 hover:text-[#17344D] text-xs font-medium"><i class="fa-solid fa-certificate text-[#17344D] w-4 mr-2"></i> {{ $siteSettings->menu_validar_cert ?? 'Validar Certificado' }}</a>
                @endif
              </div>
            </div>
          </div>
        @endif -->

        @if($siteSettings->modulo_noticias ?? true)
          <a href="{{ route('noticias') }}" class="{{ request()->routeIs('noticias') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#17344D] py-2 transition-colors' }}">
            <!-- <i class="fa-solid fa-newspaper text-[#17344D] w-4 mr-2"></i>  -->
            {{ $siteSettings->menu_noticias ?? 'Notícias' }}</a>
        @endif

        @if($siteSettings->modulo_cursos ?? true)
          <a href="{{ route('cursos') }}" class="{{ request()->routeIs('cursos') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#17344D] py-2 transition-colors' }}">
            <!-- <i class="fa-solid fa-graduation-cap text-[#17344D] w-4 mr-2"></i>  -->
            {{ $siteSettings->menu_cursos ?? 'Eventos' }}</a>
        @endif

        @if($siteSettings->modulo_prerrogativas ?? true)
          <a href="{{ route('prerrogativas') }}" class="{{ request()->routeIs('prerrogativas') ? 'text-[#C6282D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#C6282D] text-slate-800 font-semibold py-2 transition-colors' }} flex items-center gap-1.5">
            <i class="fa-solid fa-shield-halved text-[#C6282D]"></i> {{ $siteSettings->menu_prerrogativas ?? 'Prerrogativas 24h' }}
          </a>
        @endif

        
        <a href="{{ route('trabalhe-conosco') }}" class="{{ request()->routeIs('trabalhe-conosco') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#17344D] py-2 transition-colors' }}">
          Envie seu currículo
        </a>
        
        <a href="{{ route('contato') }}" class="{{ request()->routeIs('contato') ? 'text-[#17344D] font-bold border-b-2 border-[#C6282D] pb-1' : 'hover:text-[#17344D] py-2 transition-colors' }}">{{ $siteSettings->menu_contato ?? 'Contato' }}</a>
      </nav>

      <!-- CTAs DESKTOP -->
      <div class="hidden xl:flex items-center gap-3 shrink-0 whitespace-nowrap">
        @if($siteSettings->modulo_carteirinha ?? true)
          <a href="{{ route('membro.carteirinha') }}" class="px-3 py-2 text-[#17344D] hover:text-[#C6282D] font-title font-bold text-xs transition-all flex items-center gap-1.5">
            <i class="fa-solid fa-id-card text-[#17344D]"></i> {{ $siteSettings->menu_carteirinha ?? 'Carteirinha' }}
          </a>
        @endif

        @if($siteSettings->modulo_representantes ?? true)
          <a href="{{ route('representantes') }}" class="px-3.5 py-2 border-2 border-[#17344D] text-[#17344D] hover:bg-[#17344D] hover:text-white font-title font-bold text-xs rounded-lg transition-all flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-location-crosshairs text-[#C6282D]"></i> {{ $siteSettings->menu_representantes ?? 'MAR no seu Estado' }}
          </a>
        @endif

        @if($siteSettings->modulo_associacao ?? true)
          <a href="{{ route('associar') }}" class="btn-accent-mar text-xs py-2.5 px-4 shadow-sm">
            {{ $siteSettings->menu_associar ?? 'Seja um Associado' }}
          </a>
        @endif
      </div>

      <!-- BOTÃO MOBILE MENU HAMBÚRGUER -->
      <button id="mobile-menu-toggle" aria-label="Abrir Menu" class="xl:hidden text-slate-800 hover:text-[#C6282D] p-2.5 rounded-lg focus:outline-none bg-slate-100 shrink-0">
        <i class="fa-solid fa-bars text-xl"></i>
      </button>

    </div>
  </header>

  <!-- MOBILE OFF-CANVAS DRAWER NAV -->
  <div id="mobile-drawer-backdrop" class="mobile-drawer-backdrop"></div>

  <div id="mobile-drawer" class="mobile-drawer-content">
    <div class="p-4 border-b border-slate-200 flex justify-between items-center bg-slate-50">
      <img src="{{ $portalLogo }}" alt="{{ $portalName }}" class="h-9 w-auto object-contain">
      <button id="mobile-drawer-close" aria-label="Fechar Menu" class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center hover:bg-[#C6282D] hover:text-white transition-colors">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <div class="p-5 space-y-6 flex-grow overflow-y-auto">
      <div class="space-y-1">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">Navegação Principal</div>
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-bold text-[#17344D] bg-slate-100"><i class="fa-solid fa-house text-[#C6282D]"></i> {{ $siteSettings->menu_inicio ?? 'Início' }}</a>
        
        @if($siteSettings->modulo_carteirinha ?? true)
          <a href="{{ route('membro.carteirinha') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold text-[#17344D] hover:bg-slate-50"><i class="fa-solid fa-id-card text-[#17344D]"></i> {{ $siteSettings->menu_carteirinha ?? 'Carteirinha Digital' }}</a>
        @endif

        @if($siteSettings->modulo_prerrogativas ?? true)
          <a href="{{ route('prerrogativas') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-bold text-[#C6282D] hover:bg-red-50"><i class="fa-solid fa-shield-halved text-[#C6282D]"></i> {{ $siteSettings->menu_prerrogativas ?? 'Prerrogativas 24h' }}</a>
        @endif

        <a href="{{ route('contato') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-envelope text-[#17344D]"></i> {{ $siteSettings->menu_contato ?? 'Fale Conosco' }}</a>
      </div>

      @if(($siteSettings->modulo_diretoria ?? true) || ($siteSettings->modulo_representantes ?? true) || ($siteSettings->modulo_honorarios ?? true))
        <div class="space-y-1">
          <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">{{ $siteSettings->menu_institucional ?? 'Institucional' }}</div>
          @if($siteSettings->modulo_diretoria ?? true)
            <a href="{{ route('diretoria') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-users text-[#17344D] w-4"></i> {{ $siteSettings->menu_diretoria ?? 'Diretoria e Comissões' }}</a>
          @endif
          @if($siteSettings->modulo_representantes ?? true)
            <a href="{{ route('representantes') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-map-location-dot text-[#17344D] w-4"></i> {{ $siteSettings->menu_representantes ?? 'Representantes por Estado' }}</a>
          @endif
          @if($siteSettings->modulo_honorarios ?? true)
            <a href="{{ route('membros-honorarios') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-award text-[#17344D] w-4"></i> {{ $siteSettings->menu_honorarios ?? 'Membros Honorários' }}</a>
          @endif
        </div>
      @endif

      @if(($siteSettings->modulo_noticias ?? true) || ($siteSettings->modulo_atos_oficiais ?? true) || ($siteSettings->modulo_cursos ?? true) || ($siteSettings->modulo_certificados ?? true))
        <div class="space-y-1">
          <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">{{ $siteSettings->menu_conteudo ?? 'Conteúdo & Atos' }}</div>
          @if($siteSettings->modulo_noticias ?? true)
            <a href="{{ route('noticias') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-newspaper text-[#17344D] w-4"></i> {{ $siteSettings->menu_noticias ?? 'Notícias e Portal' }}</a>
          @endif
          @if($siteSettings->modulo_atos_oficiais ?? true)
            <a href="{{ route('notas-oficiais') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-scroll text-[#17344D] w-4"></i> {{ $siteSettings->menu_atos ?? 'Notas e Atos Oficiais' }}</a>
          @endif
          @if($siteSettings->modulo_cursos ?? true)
            <a href="{{ route('cursos') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-graduation-cap text-[#17344D] w-4"></i> {{ $siteSettings->menu_cursos ?? 'Cursos e Palestras' }}</a>
          @endif
          @if($siteSettings->modulo_certificados ?? true)
            <a href="{{ route('certificados.validar') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-solid fa-certificate text-[#17344D] w-4"></i> {{ $siteSettings->menu_validar_cert ?? 'Validar Certificado' }}</a>
          @endif
        </div>
      @endif

      @if($siteSettings->modulo_associacao ?? true)
        <div class="pt-4 border-t border-slate-200 space-y-3">
          <a href="{{ route('associar') }}" class="btn-accent-mar w-full text-center text-xs py-3 rounded-lg shadow-sm block">
            <i class="fa-solid fa-user-plus mr-1"></i> {{ $siteSettings->menu_associar ?? 'Seja um Associado MAR' }}
          </a>
        </div>
      @endif
    </div>
  </div>

  <!-- CONTEÚDO DA PÁGINA -->
  <main class="flex-grow">
    @yield('content')
  </main>

  <!-- FOOTER INSTITUCIONAL -->
  <footer class="bg-[#17344D] text-white border-t-4 border-[#C6282D] pt-12 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
        
        <!-- Coluna 1: Sobre -->
        <div class="space-y-4">
          <img src="{{ $portalLogo }}" alt="{{ $portalName }}" class="h-10 w-auto bg-white p-2 rounded-lg">
          <p class="text-xs text-slate-300 leading-relaxed">
            O <b>{{ $portalName }}</b> é uma instituição dedicada à valorização, modernização e independência da advocacia brasileira.
          </p>
        </div>

        <!-- Coluna 2: Navegação -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-700 pb-2">{{ $siteSettings->menu_institucional ?? 'Institucional' }}</h4>
          <ul class="space-y-2 text-xs text-slate-300">
            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_inicio ?? 'Início' }}</a></li>
            @if($siteSettings->modulo_diretoria ?? true)
              <li><a href="{{ route('diretoria') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_diretoria ?? 'Diretoria Executiva' }}</a></li>
            @endif
            @if($siteSettings->modulo_representantes ?? true)
              <li><a href="{{ route('representantes') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_representantes ?? 'Representantes por UF' }}</a></li>
            @endif
            @if($siteSettings->modulo_honorarios ?? true)
              <li><a href="{{ route('membros-honorarios') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_honorarios ?? 'Membros Honorários' }}</a></li>
            @endif
            @if($siteSettings->modulo_prerrogativas ?? true)
              <li><a href="{{ route('prerrogativas') }}" class="text-red-300 hover:text-white font-bold transition-colors"><i class="fa-solid fa-shield-halved mr-1"></i> {{ $siteSettings->menu_prerrogativas ?? 'Prerrogativas 24h' }}</a></li>
            @endif
          </ul>
        </div>

        <!-- Coluna 3: Transparência -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-700 pb-2">{{ $siteSettings->menu_conteudo ?? 'Transparência & Atendimento' }}</h4>
          <ul class="space-y-2 text-xs text-slate-300">
            @if($siteSettings->modulo_noticias ?? true)
              <li><a href="{{ route('noticias') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_noticias ?? 'Portal de Notícias' }}</a></li>
            @endif
            @if($siteSettings->modulo_atos_oficiais ?? true)
              <li><a href="{{ route('notas-oficiais') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_atos ?? 'Notas e Atos Oficiais' }}</a></li>
            @endif
            @if($siteSettings->modulo_cursos ?? true)
              <li><a href="{{ route('cursos') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_cursos ?? 'Cursos e Eventos' }}</a></li>
            @endif
            <li><a href="{{ route('contato') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_contato ?? 'Fale Conosco / Ouvidoria' }}</a></li>
            @if($siteSettings->modulo_associacao ?? true)
              <li><a href="{{ route('associar') }}" class="hover:text-white transition-colors">{{ $siteSettings->menu_associar ?? 'Seja um Associado' }}</a></li>
            @endif
          </ul>
        </div>

        <!-- Coluna 4: Contato & Redes -->
        <div>
          <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-700 pb-2">{{ $siteSettings->menu_contato ?? 'Contato Institucional' }}</h4>
          <p class="text-xs text-slate-300 mb-2">
            <a href="mailto:{{ $siteSettings->email_contato ?? 'contato@institutomar.org.br' }}" class="hover:text-white transition-colors">
              <i class="fa-solid fa-envelope text-[#C6282D] mr-2"></i> {{ $siteSettings->email_contato ?? 'contato@institutomar.org.br' }}
            </a>
          </p>

          <p class="text-xs text-slate-300 mb-2">
            <a href="{{ route('trabalhe-conosco') }}" class="hover:text-white transition-colors">
              <i class="fa-solid fa-file-pdf text-[#C6282D] mr-2"></i> Envie seu currículo
            </a>
          </p>
          @if($siteSettings->modulo_prerrogativas ?? true)
            <p class="text-xs text-slate-300 mb-3">
              <a href="{{ route('prerrogativas') }}" class="hover:text-white transition-colors">
                <i class="fa-solid fa-phone-volume text-[#C6282D] mr-2"></i> {{ $siteSettings->telefone_plantao ?? 'Plantão de Prerrogativas 24h' }}
              </a>
            </p>
          @endif
          <div class="flex flex-wrap gap-3">
            @if(!empty($siteSettings->instagram_url))
              <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#C6282D] text-white text-xs transition-colors" title="Instagram Oficial"><i class="fa-brands fa-instagram"></i></a>
            @endif
            @if(!empty($siteSettings->linkedin_url))
              <a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#C6282D] text-white text-xs transition-colors" title="LinkedIn Oficial"><i class="fa-brands fa-linkedin-in"></i></a>
            @endif
            @if(!empty($siteSettings->youtube_url))
              <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#C6282D] text-white text-xs transition-colors" title="YouTube Oficial"><i class="fa-brands fa-youtube"></i></a>
            @endif
            @if(!empty($siteSettings->twitter_url))
              <a href="{{ $siteSettings->twitter_url }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#C6282D] text-white text-xs transition-colors" title="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
            @endif
            @if(!empty($siteSettings->facebook_url))
              <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#C6282D] text-white text-xs transition-colors" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            @endif
          </div>
        </div>

      </div>

      <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-4">
        <p>© {{ date('Y') }} Instituto MAR — Movimento da Advocacia Renovada. Todos os direitos reservados.</p>
        <div class="flex items-center gap-4 text-[11px]">
          <a href="{{ route('politica-privacidade') }}" class="hover:text-white transition-colors">Política de Privacidade</a>
          <span>•</span>
          <a href="{{ route('termos-uso') }}" class="hover:text-white transition-colors">Termos de Uso</a>
          <span>•</span>
          <a href="{{ route('filament.admin.auth.login') }}" class="hover:text-white transition-colors"><i class="fa-solid fa-lock text-[10px] mr-1"></i> Admin</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts Global -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @livewireScripts
  @stack('scripts')
</body>
</html>
