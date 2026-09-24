@extends('layouts.app')

@section('title', 'Instituto MAR — Movimento da Advocacia Renovada')

@section('content')
  <!-- HERO SECTION -->
  <section class="relative bg-gradient-to-b from-[#17344D] to-[#0F2334] text-white py-14 sm:py-20 lg:py-24 px-4 sm:px-6 md:px-8 overflow-hidden">
    <div class="absolute -right-20 -bottom-20 w-80 sm:w-96 h-80 sm:h-96 rounded-full border border-white/5 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-center relative z-10">
      <div class="lg:col-span-7 space-y-5 sm:space-y-6 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 text-slate-200 text-[11px] sm:text-xs font-semibold tracking-wider uppercase backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-[#C6282D] animate-pulse"></span>
          INSTITUTO MOVIMENTO DA ADVOCACIA RENOVADA
        </div>

        <h1 class="font-title font-extrabold text-2xl sm:text-4xl lg:text-5xl leading-tight tracking-tight text-white">
          Uma advocacia forte se constrói com <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-[#C6282D]">participação, compromisso e renovação.</span>
        </h1>

        <p class="text-slate-300 text-sm sm:text-base lg:text-lg leading-relaxed max-w-2xl font-light mx-auto lg:mx-0">
          O MAR nasceu para fortalecer a advocacia, ampliar a representatividade e promover uma atuação institucional comprometida com a ética, a justiça e a transformação da sociedade.
        </p>

        <div class="pt-2 flex flex-col sm:flex-row items-stretch justify-center lg:justify-start gap-3">
          <a href="#posicionamento" class="btn-primary-mar bg-white text-[#17344D] hover:bg-slate-100 font-bold px-6 py-3.5 text-xs sm:text-sm shadow-lg">
            Conheça o Instituto <i class="fa-solid fa-arrow-right text-xs ml-1"></i>
          </a>
          <a href="{{ route('associar') }}" class="btn-accent-mar px-6 py-3.5 text-xs sm:text-sm shadow-xl">
            <i class="fa-solid fa-user-plus mr-1.5"></i> Seja um Associado
          </a>
        </div>

        <div class="pt-6 border-t border-white/10 grid grid-cols-3 gap-2 text-center text-xs text-slate-300">
          <div>
            <div class="font-bold text-white text-xs sm:text-sm"><i class="fa-solid fa-shield-halved text-[#C6282D] mr-1"></i> Ética</div>
            <div class="text-slate-400 text-[10px] sm:text-[11px]">Compromisso</div>
          </div>
          <div>
            <div class="font-bold text-white text-xs sm:text-sm"><i class="fa-solid fa-scale-balanced text-[#C6282D] mr-1"></i> Justiça</div>
            <div class="text-slate-400 text-[10px] sm:text-[11px]">Fortalecimento</div>
          </div>
          <div>
            <div class="font-bold text-white text-xs sm:text-sm"><i class="fa-solid fa-handshake text-[#C6282D] mr-1"></i> União</div>
            <div class="text-slate-400 text-[10px] sm:text-[11px]">Presença Nacional</div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-5 relative mt-4 lg:mt-0">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 group">
          <img src="{{ asset('assets/images/logo-mar.png') }}" alt="Instituto MAR — Movimento da Advocacia Renovada" class="w-full  sm:h-96 lg:h-[200px] group-hover:scale-80 transition-transform duration-700" style="height: auto;">
          <div class="absolute inset-0 bg-gradient-to-t from-[#17344D] via-transparent to-transparent opacity-80"></div>
          <!-- <div class="absolute bottom-4 left-4 right-4 p-3.5 rounded-xl bg-[#17344D]/90 backdrop-blur-md border border-white/10 text-white">
            <p class="text-[10px] font-semibold text-slate-300 uppercase tracking-wider mb-0.5">União & Liderança</p>
            <p class="text-xs sm:text-sm font-title font-medium leading-snug">"Conectando advogados em todo o Brasil para protagonizar o futuro do Direito."</p>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <!-- POSICIONAMENTO -->
  <section id="posicionamento" class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-white">
    <div class="max-w-5xl mx-auto text-center space-y-6 sm:space-y-8">
      <span class="inline-block badge-navy text-xs tracking-widest font-bold uppercase">POR QUE EXISTIMOS</span>

      <h2 class="font-title text-xl sm:text-3xl md:text-4xl font-extrabold text-[#17344D] leading-tight max-w-4xl mx-auto">
        A advocacia exerce uma função que ultrapassa os limites dos processos e tribunais.
      </h2>

      <p class="text-slate-600 text-xs sm:text-base md:text-lg leading-relaxed max-w-3xl mx-auto font-normal">
        Defender a advocacia é defender também as instituições, as garantias fundamentais, a democracia e o acesso à Justiça. O Instituto MAR foi criado para ser o espaço legítimo de convergência dos profissionais que acreditam na renovação ética e na representatividade ativa da nossa classe.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 pt-4 sm:pt-8 text-left">
        <div class="md-card p-5 sm:p-6 border-l-4 border-l-[#17344D] hover:border-l-[#C6282D]">
          <div class="w-10 sm:w-12 h-10 sm:h-12 rounded-lg bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg sm:text-xl mb-3 font-bold">
            <i class="fa-solid fa-shield-heart"></i>
          </div>
          <h3 class="font-title font-bold text-base sm:text-lg text-[#17344D] mb-1.5">Ética</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Valorizar uma conduta pautada pela transparência, integridade e respeito às prerrogativas.
          </p>
        </div>

        <div class="md-card p-5 sm:p-6 border-l-4 border-l-[#17344D] hover:border-l-[#C6282D]">
          <div class="w-10 sm:w-12 h-10 sm:h-12 rounded-lg bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg sm:text-xl mb-3 font-bold">
            <i class="fa-solid fa-scale-balanced"></i>
          </div>
          <h3 class="font-title font-bold text-base sm:text-lg text-[#17344D] mb-1.5">Justiça</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Contribuir diretamente para a solidez das instituições democráticas e aperfeiçoamento jurisdicional.
          </p>
        </div>

        <div class="md-card p-5 sm:p-6 border-l-4 border-l-[#17344D] hover:border-l-[#C6282D]">
          <div class="w-10 sm:w-12 h-10 sm:h-12 rounded-lg bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg sm:text-xl mb-3 font-bold">
            <i class="fa-solid fa-hands-holding-circle"></i>
          </div>
          <h3 class="font-title font-bold text-base sm:text-lg text-[#17344D] mb-1.5">Compromisso</h3>
          <p class="text-xs text-slate-600 leading-relaxed">
            Dedicação à formação continuada, à valorização do advogado e novas lideranças.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- MANIFESTO -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-[#F4F6F8] border-y border-slate-200">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
      <div class="lg:col-span-5 space-y-4 sm:space-y-6 text-center lg:text-left">
        <span class="badge-mar text-xs font-bold tracking-widest uppercase">MANIFESTO MAR</span>
        <h2 class="font-title text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#17344D] leading-tight">
          Renovar não significa romper com a advocacia. Significa prepará-la para o futuro.
        </h2>
        <div class="w-16 h-1 bg-[#C6282D] rounded-full mx-auto lg:mx-0"></div>
      </div>

      <div class="lg:col-span-7 bg-white p-6 sm:p-10 rounded-2xl shadow-sm border border-slate-200/80 space-y-4 text-slate-700 text-xs sm:text-sm md:text-base leading-relaxed">
        <p>
          O Movimento da Advocacia Renovada surge do entendimento profundo de que os desafios contemporâneos da sociedade exigem uma representação cada vez mais qualificada, combativa e conectada com a realidade dos advogados e advogadas.
        </p>
        <p>
          Trabalhamos para garantir que cada profissional encontre no Instituto MAR voz ativa, apoio técnico e um ambiente de desenvolvimento contínuo. A defesa das prerrogativas não é apenas um discurso; é a base da nossa existência.
        </p>
        <div class="p-4 bg-[#17344D]/5 border-l-4 border-[#17344D] rounded-r-lg font-medium text-[#17344D] italic text-xs sm:text-sm">
          "Acreditamos na força da unidade, na pluralidade de ideias e na construção de caminhos que honrem a história da advocacia enquanto abrem portas para novas lideranças."
        </div>
      </div>
    </div>
  </section>

  <!-- PILARES DO MAR -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-white">
    <div class="max-w-7xl mx-auto space-y-10 sm:space-y-12">
      <div class="text-center max-w-3xl mx-auto space-y-2 sm:space-y-3">
        <span class="badge-navy text-xs font-bold tracking-widest uppercase">FUNDAMENTOS</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D]">Os Pilares do Instituto MAR</h2>
        <p class="text-slate-600 text-xs sm:text-sm">Diretrizes estratégicas que orientam todas as nossas iniciativas e representações.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
        <div class="md-card p-5 sm:p-6 text-center space-y-3 hover:border-[#17344D]">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-[#17344D] flex items-center justify-center text-xl font-bold">
            <i class="fa-solid fa-bullhorn"></i>
          </div>
          <h3 class="font-title font-bold text-base text-[#17344D]">Representatividade</h3>
          <p class="text-xs text-slate-600">Ampliar a participação e fortalecer a voz da advocacia em todas as instâncias.</p>
        </div>

        <div class="md-card p-5 sm:p-6 text-center space-y-3 hover:border-[#17344D]">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-[#17344D] flex items-center justify-center text-xl font-bold">
            <i class="fa-solid fa-book-open"></i>
          </div>
          <h3 class="font-title font-bold text-base text-[#17344D]">Formação</h3>
          <p class="text-xs text-slate-600">Criar espaços para aprendizado, desenvolvimento técnico e troca de experiências.</p>
        </div>

        <div class="md-card p-5 sm:p-6 text-center space-y-3 hover:border-[#17344D]">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-[#17344D] flex items-center justify-center text-xl font-bold">
            <i class="fa-solid fa-gavel"></i>
          </div>
          <h3 class="font-title font-bold text-base text-[#17344D]">Ética</h3>
          <p class="text-xs text-slate-600">Valorizar uma advocacia comprometida com princípios, transparência e responsabilidade.</p>
        </div>

        <div class="md-card p-5 sm:p-6 text-center space-y-3 hover:border-[#17344D]">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-[#17344D] flex items-center justify-center text-xl font-bold">
            <i class="fa-solid fa-building-columns"></i>
          </div>
          <h3 class="font-title font-bold text-base text-[#17344D]">Justiça</h3>
          <p class="text-xs text-slate-600">Contribuir para o fortalecimento das instituições democráticas e garantias fundamentais.</p>
        </div>

        <div class="md-card p-5 sm:p-6 text-center space-y-3 hover:border-[#17344D] sm:col-span-2 lg:col-span-1">
          <div class="w-12 h-12 mx-auto rounded-full bg-[#C6282D]/10 text-[#C6282D] flex items-center justify-center text-xl font-bold">
            <i class="fa-solid fa-lightbulb"></i>
          </div>
          <h3 class="font-title font-bold text-base text-[#17344D]">Renovação</h3>
          <p class="text-xs text-slate-600">Estimular novas ideias, novas lideranças e novas formas de participação institucional.</p>
        </div>
      </div>
    </div>
  </section>

  @if($siteSettings->modulo_representantes ?? true)
  <!-- MAR NO SEU ESTADO -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-[#17344D] text-white">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
      <div class="lg:col-span-5 space-y-5 text-center lg:text-left">
        <span class="inline-block bg-[#C6282D] text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">PRESENÇA NACIONAL</span>
        <h2 class="font-title text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight">
          O MAR também acontece onde você está.
        </h2>
        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
          O Instituto possui representantes e comissões atuantes nos estados brasileiros, garantindo apoio direto aos advogados.
        </p>

        <div class="p-5 bg-white/5 border border-white/10 rounded-xl space-y-2 text-left">
          <div class="text-[10px] text-slate-400 uppercase font-semibold">Estado Selecionado</div>
          <div id="selected-uf-name" class="font-title font-bold text-lg sm:text-xl text-white">São Paulo (SP)</div>
          <div id="selected-uf-count" class="text-xs text-red-400 font-medium"><i class="fa-solid fa-users mr-1"></i> 14 Representantes Ativos</div>
        </div>

        <a href="{{ route('representantes') }}" class="btn-accent-mar inline-flex w-full sm:w-auto justify-center px-6 py-3.5 text-xs">
          Encontre os Representantes no Seu Estado <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>

      <div class="lg:col-span-7 bg-white/5 border border-white/10 rounded-2xl p-5 sm:p-8 backdrop-blur-sm">
        <div class="text-center mb-5 text-xs text-slate-300 font-medium">Toque no estado para consultar a presença institucional:</div>
        
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 text-center text-xs font-bold">
          <button data-uf="SP" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">SP</button>
          <button data-uf="RJ" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">RJ</button>
          <button data-uf="MG" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">MG</button>
          <button data-uf="BA" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">BA</button>
          <button data-uf="RS" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">RS</button>
          <button data-uf="PR" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">PR</button>
          <button data-uf="PE" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">PE</button>
          <button data-uf="DF" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">DF</button>
          <button data-uf="CE" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">CE</button>
          <button data-uf="SC" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">SC</button>
          <button data-uf="GO" class="map-uf has-rep p-3 bg-white/10 rounded-lg text-white hover:bg-[#C6282D]">GO</button>
          <a href="{{ route('representantes') }}" class="p-3 bg-[#C6282D] text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center font-semibold text-xs">Todos →</a>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if($siteSettings->modulo_cursos && $events->count() > 0)
  <!-- EVENTOS DESTAQUE -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-white">
    <div class="max-w-7xl mx-auto space-y-8">
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-3 border-b border-slate-200 pb-4">
        <div>
          <span class="badge-mar text-xs font-bold uppercase">AGENDA INSTITUCIONAL</span>
          <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-1">Próximos Eventos</h2>
        </div>
        <a href="{{ route('cursos') }}" class="text-xs font-bold text-[#17344D] hover:text-[#C6282D] flex items-center gap-1">
          Ver todos os eventos <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        @forelse($events as $event)
          <div class="md-card overflow-hidden flex flex-col justify-between group">
            <div>
              <div class="bg-[#17344D] text-white p-3.5 flex justify-between items-center text-xs font-bold">
                <span><i class="fa-regular fa-calendar-check mr-1.5 text-red-400"></i> {{ $event->data_evento ? $event->data_evento->translatedFormat('d M, Y') : '' }}</span>
                <span class="bg-white/20 px-2 py-0.5 rounded text-[10px] uppercase">{{ $event->formato }}</span>
              </div>
              <div class="p-5 space-y-2.5">
                <span class="badge-navy text-[10px]">{{ $event->carga_horaria }}</span>
                <h3 class="font-title font-bold text-base sm:text-lg text-[#17344D] group-hover:text-[#C6282D] transition-colors leading-snug">
                  <a href="{{ route('curso.show', $event->slug) }}">
                    {{ $event->titulo }}
                  </a>
                </h3>
                <p class="text-xs text-slate-600 line-clamp-3">{{ $event->subtitulo }}</p>
              </div>
            </div>
            <div class="p-5 pt-0 border-t border-slate-100 mt-3 flex justify-between items-center text-xs">
              <span class="text-slate-500 truncate max-w-[150px]"><i class="fa-solid fa-location-dot text-[#C6282D] mr-1"></i> {{ $event->local }}</span>
              <a href="{{ route('curso.show', $event->slug) }}" class="font-bold text-[#17344D] hover:text-[#C6282D]">Detalhes →</a>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-8 text-slate-500 text-sm">
            Nenhum evento agendado no momento.
          </div>
        @endforelse
      </div>
    </div>
  </section>
  @endif

  @if($siteSettings->modulo_noticias ?? true)
  <!-- PORTAL DE NOTÍCIAS -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-[#F4F6F8]">
    <div class="max-w-7xl mx-auto space-y-8">
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-3 border-b border-slate-200 pb-4">
        <div>
          <span class="badge-navy text-xs font-bold uppercase">COMUNICAÇÃO</span>
          <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-1">Notícias & Atuação Institucional</h2>
        </div>
        <a href="{{ route('noticias') }}" class="text-xs font-bold text-[#17344D] hover:text-[#C6282D]">Portal Completo →</a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        @if(isset($posts) && $posts->count() > 0)
          @php $mainPost = $posts->first(); @endphp
          <div class="lg:col-span-7 md-card overflow-hidden flex flex-col justify-between group">
            <div class="relative h-56 sm:h-72 overflow-hidden bg-slate-900">
              <img src="{{ $mainPost->imagem_capa ?: asset('assets/images/placeholder-mar.svg') }}" alt="{{ $mainPost->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <div class="absolute top-3 left-3 bg-[#C6282D] text-white text-[10px] font-bold uppercase px-2.5 py-1 rounded">
                {{ $mainPost->categoria }}
              </div>
            </div>
            <div class="p-5 sm:p-6 space-y-3">
              <div class="text-xs text-slate-400 font-medium">
                {{ $mainPost->publicado_em ? $mainPost->publicado_em->translatedFormat('d \d\e F, Y') : '' }}
              </div>
              <h3 class="font-title font-bold text-lg sm:text-xl text-[#17344D] group-hover:text-[#C6282D] transition-colors leading-snug">
                <a href="{{ route('noticia.show', $mainPost->slug) }}">
                  {{ $mainPost->titulo }}
                </a>
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                {{ $mainPost->resumo }}
              </p>
              <a href="{{ route('noticia.show', $mainPost->slug) }}" class="inline-block text-xs font-bold text-[#17344D] pt-1">
                Leia a matéria completa <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
              </a>
            </div>
          </div>

          <div class="lg:col-span-5 space-y-4">
            @foreach($posts->slice(1, 3) as $sidePost)
              <a href="{{ route('noticia.show', $sidePost->slug) }}" class="md-card p-4 flex gap-3.5 items-center hover:border-[#17344D] group block transition-all">
                <div class="w-20 h-20 rounded-lg bg-slate-200 overflow-hidden shrink-0">
                  <img src="{{ $sidePost->imagem_capa ?: asset('assets/images/placeholder-mar.svg') }}" alt="{{ $sidePost->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                </div>
                <div class="space-y-1">
                  <span class="text-[10px] font-bold text-[#C6282D] uppercase">{{ $sidePost->categoria }}</span>
                  <h4 class="font-title font-bold text-xs sm:text-sm text-[#17344D] group-hover:text-[#C6282D] line-clamp-2 transition-colors">
                    {{ $sidePost->titulo }}
                  </h4>
                  <span class="text-[10px] text-slate-400">
                    {{ $sidePost->publicado_em ? $sidePost->publicado_em->translatedFormat('d \d\e F, Y') : '' }}
                  </span>
                </div>
              </a>
            @endforeach
          </div>
        @else
          <div class="col-span-12 text-center py-10 text-slate-500">
            <p>Nenhuma notícia disponível no momento.</p>
          </div>
        @endif
      </div>
    </div>
  </section>
  @endif

  @if($siteSettings->modulo_associacao ?? true)
  <!-- CTA SEJA UM ASSOCIADO -->
  <section class="py-16 sm:py-20 px-4 sm:px-6 md:px-8 bg-gradient-to-r from-[#17344D] via-[#0F2334] to-[#17344D] text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto space-y-5 relative z-10">
      <span class="bg-[#C6282D] text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest px-3.5 py-1.5 rounded-full inline-block">CONVITE INSTITUCIONAL</span>
      <h2 class="font-title text-2xl sm:text-4xl md:text-5xl font-extrabold leading-tight">
        Sua atuação profissional também pode fazer parte de uma construção coletiva.
      </h2>
      <p class="text-slate-300 text-xs sm:text-base max-w-2xl mx-auto font-light leading-relaxed">
        Associar-se ao MAR é participar ativamente de uma rede nacional comprometida com a valorização da advocacia, a formação continuada e a representatividade.
      </p>
      <div class="pt-2">
        <a href="{{ route('associar') }}" class="btn-accent-mar w-full sm:w-auto text-xs sm:text-sm px-8 py-4 shadow-2xl">
          Quero ser um Associado ao MAR <i class="fa-solid fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>
  @endif
@endsection
