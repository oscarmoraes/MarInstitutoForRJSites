@extends('layouts.app')

@section('title', $post->titulo . ' — Instituto MAR')

@section('content')
  <!-- BREADCRUMB NAV -->
  <div class="bg-[#17344D] text-white py-4 px-4 sm:px-6 lg:px-8 border-b border-slate-700 text-xs">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center gap-2 text-slate-300">
      <a href="{{ route('home') }}" class="hover:text-white"><i class="fa-solid fa-house mr-1"></i> Início</a>
      <span>/</span>
      <a href="{{ route('noticias') }}" class="hover:text-white">Notícias e Portal</a>
      <span>/</span>
      <span class="text-white font-semibold truncate max-w-xs sm:max-w-md">{{ $post->titulo }}</span>
    </div>
  </div>

  <!-- CONTEÚDO DA MATÉRIA -->
  <article class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- COLUNA PRINCIPAL DA NOTÍCIA -->
      <div class="lg:col-span-8 space-y-8">
        
        <!-- CABEÇALHO DO ARTIGO -->
        <header class="space-y-4">
          <div class="flex flex-wrap items-center gap-3 text-xs">
            <span class="bg-[#C6282D] text-white font-bold uppercase tracking-wider px-3 py-1 rounded">
              {{ $post->categoria }}
            </span>
            @if($post->publicado_em)
              <span class="text-slate-500 font-medium">
                <i class="fa-regular fa-calendar mr-1"></i> {{ $post->publicado_em->translatedFormat('d \d\e F \d\e Y') }}
              </span>
              <span class="text-slate-400">•</span>
            @endif
            <span class="text-slate-500 font-medium">
              <i class="fa-regular fa-clock mr-1"></i> {{ $post->tempo_leitura ?? '4 min' }} de leitura
            </span>
          </div>

          <h1 class="font-title font-extrabold text-2xl sm:text-4xl text-[#17344D] leading-tight">
            {{ $post->titulo }}
          </h1>

          @if($post->resumo)
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed font-light border-l-4 border-[#17344D] pl-4 py-1 italic">
              {{ $post->resumo }}
            </p>
          @endif

          <!-- AUTOR E COMPARTILHAMENTO -->
          <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-y border-slate-200 text-xs text-slate-500">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-[#17344D] text-white flex items-center justify-center font-bold text-sm">
                <i class="fa-solid fa-user-pen"></i>
              </div>
              <div>
                <div class="font-bold text-[#17344D]">{{ $post->autor ?: 'Assessoria de Imprensa MAR' }}</div>
                <div class="text-[11px] text-slate-400">Diretoria de Comunicação Institucional</div>
              </div>
            </div>

            <!-- BOTOES DE COMPARTILHAMENTO -->
            <div class="flex items-center gap-2">
              <span class="font-bold text-[#17344D] mr-1">Compartilhar:</span>
              <a href="https://api.whatsapp.com/send?text={{ urlencode($post->titulo . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="Compartilhar no WhatsApp">
                <i class="fa-brands fa-whatsapp"></i>
              </a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-blue-700 text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="Compartilhar no LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i>
              </a>
              <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copiado com sucesso!');" class="w-8 h-8 rounded-full bg-slate-800 text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="Copiar Link">
                <i class="fa-solid fa-link"></i>
              </button>
            </div>
          </div>
        </header>

        <!-- IMAGEM DE CAPA -->
        @if($post->imagem_capa)
          <figure class="space-y-2">
            <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-200 bg-slate-900">
              <img src="{{ asset('storage') . '/' . $post->imagem_capa }}" class="w-full h-72 sm:h-[420px] object-cover">
            </div>
            <figcaption class="text-[11px] text-slate-500 text-center italic">
              {{ $post->titulo }}
            </figcaption>
          </figure>
        @endif

        <!-- CORPO DA NOTÍCIA -->
        <div class="prose max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-6">
          {!! $post->conteudo !!}
        </div>

        <!-- TAGS E RODAPÉ DO ARTIGO -->
        <div class="pt-6 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">
          <div class="flex flex-wrap items-center gap-2 text-xs">
            <span class="font-bold text-slate-500 mr-1">Categoria:</span>
            <span class="px-3 py-1 bg-slate-100 text-[#17344D] font-semibold rounded-full">#{{ $post->categoria }}</span>
            <span class="px-3 py-1 bg-slate-100 text-[#17344D] font-semibold rounded-full">#InstitutoMAR</span>
            <span class="px-3 py-1 bg-slate-100 text-[#17344D] font-semibold rounded-full">#AdvocaciaRenovada</span>
          </div>

          <a href="{{ route('noticias') }}" class="text-xs font-bold text-[#17344D] hover:text-[#C6282D] flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Voltar ao Portal de Notícias
          </a>
        </div>

      </div>

      <!-- SIDEBAR DIREITA -->
      <aside class="lg:col-span-4 space-y-8">
        
        <!-- CARD CTA ASSOCIAR-SE -->
        <div class="bg-gradient-to-br from-[#17344D] to-[#0F2334] text-white p-6 rounded-2xl shadow-xl space-y-4 text-center">
          <span class="bg-[#C6282D] text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full inline-block">UNIDOS PELA ADVOCACIA</span>
          <h3 class="font-title font-bold text-lg text-white">Faça parte do Instituto MAR</h3>
          <p class="text-xs text-slate-300 font-light leading-relaxed">
            Junte-se a milhares de advogados em todo o Brasil na defesa das prerrogativas e na formação continuada.
          </p>
          <a href="{{ route('associar') }}" class="btn-accent-mar w-full text-xs py-3 shadow-md block">
            <i class="fa-solid fa-user-plus mr-1"></i> Seja um Associado MAR
          </a>
        </div>

        <!-- NOTÍCIAS RELACIONADAS -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
          <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
            <h3 class="font-title font-bold text-base text-[#17344D] border-b border-slate-100 pb-3 flex items-center gap-2">
              <i class="fa-solid fa-newspaper text-[#C6282D]"></i> Notícias Relacionadas
            </h3>

            <div class="space-y-4">
              @foreach($relatedPosts as $related)
                <a href="{{ route('noticia.show', $related->slug) }}" class="block group">
                  <span class="text-[10px] font-bold text-[#C6282D] uppercase">{{ $related->categoria }}</span>
                  <h4 class="font-title font-bold text-xs text-[#17344D] group-hover:text-[#C6282D] transition-colors leading-snug line-clamp-2">
                    {{ $related->titulo }}
                  </h4>
                  <span class="text-[10px] text-slate-400">
                    {{ $related->publicado_em ? $related->publicado_em->translatedFormat('d \d\e F, Y') : '' }}
                  </span>
                </a>

                @if(!$loop->last)
                  <hr class="border-slate-100">
                @endif
              @endforeach
            </div>
          </div>
        @endif

      </aside>

    </div>
  </article>
@endsection
