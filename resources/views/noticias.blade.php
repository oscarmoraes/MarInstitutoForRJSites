@extends('layouts.app')

@section('title', 'Notícias e Imprensa — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">COMUNICAÇÃO INSTITUCIONAL</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Notícias & Portal de Imprensa</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Acompanhe a atuação do Instituto MAR, notas técnicas, artigos de opinião e novidades sobre o fortalecimento da advocacia em todo o Brasil.
      </p>
    </div>
  </section>

  <!-- NAVEGAÇÃO POR CATEGORIAS -->
  @if(isset($categories) && $categories->count() > 0)
    <div class="bg-white border-b border-slate-200 sticky top-[61px] z-30 px-4">
      <div class="max-w-7xl mx-auto flex items-center gap-2 overflow-x-auto py-3 text-xs font-semibold text-slate-600 no-scrollbar">
        <a href="{{ route('noticias') }}" class="px-4 py-1.5 rounded-full transition-all shrink-0 {{ empty($categoriaSelecionada) || $categoriaSelecionada === 'todas' ? 'bg-[#17344D] text-white font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
          Todas
        </a>
        @foreach($categories as $cat)
          <a href="{{ route('noticias', ['categoria' => $cat]) }}" class="px-4 py-1.5 rounded-full transition-all shrink-0 {{ $categoriaSelecionada === $cat ? 'bg-[#17344D] text-white font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
            {{ ucfirst(mb_strtolower($cat)) }}
          </a>
        @endforeach
      </div>
    </div>
  @endif

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-12 sm:space-y-16 w-full flex-grow">

    @if(isset($featuredPost) && $featuredPost)
      <!-- MATÉRIA DESTAQUE PRINCIPAL -->
      <div class="md-card overflow-hidden grid grid-cols-1 lg:grid-cols-12 gap-0 group lg:max-h-[380px]">
        <div class="lg:col-span-7 h-64 sm:h-72 lg:h-[380px] relative overflow-hidden bg-slate-900">
          @if($featuredPost->imagem_capa)
            <img src="{{ asset('storage') . '/' . $featuredPost->imagem_capa }}" alt="{{ $featuredPost->titulo }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
            @else
            <img src="{{ asset('assets/images/placeholder-mar.svg') }}" alt="{{ $featuredPost->titulo }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
          @endif
          <div class="absolute top-4 left-4 bg-[#C6282D] text-white text-xs font-bold uppercase px-3 py-1 rounded shadow-md">
            Destaque Nacional
          </div>
        </div>
        <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between space-y-4 lg:max-h-[380px]">
          <div class="space-y-3">
            <div class="text-xs text-slate-400 font-medium">
              <i class="fa-regular fa-clock mr-1"></i>
              {{ $featuredPost->publicado_em ? $featuredPost->publicado_em->translatedFormat('d \d\e F \d\e Y') : '' }} • {{ $featuredPost->categoria }}
            </div>
            <h2 class="font-title font-extrabold text-xl sm:text-2xl text-[#17344D] group-hover:text-[#C6282D] transition-colors leading-tight">
              <a href="{{ route('noticia.show', $featuredPost->slug) }}">
                {{ $featuredPost->titulo }}
              </a>
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
              {{ $featuredPost->resumo }}
            </p>
          </div>
          <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs font-bold text-[#17344D]">
              <i class="fa-solid fa-user-pen text-[#C6282D] mr-1"></i> {{ $featuredPost->autor }}
            </span>
            <a href="{{ route('noticia.show', $featuredPost->slug) }}" class="btn-primary-mar text-xs py-2.5 px-4">
              Ler Matéria Completa →
            </a>
          </div>
        </div>
      </div>
    @endif

    <!-- GRID DE NOTÍCIAS SECUNDÁRIAS -->
    @if(isset($posts) && $posts->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        @foreach($posts as $post)
          <div class="md-card overflow-hidden flex flex-col justify-between group">
            <div>
              <div class="h-48 overflow-hidden relative bg-slate-100">
                @if($post->imagem_capa)
                  <img src="{{ asset('storage') . '/' . $post->imagem_capa }}" alt="{{ $post->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                  @else
                  <img src="{{ asset('assets/images/placeholder-mar.svg') }}" alt="{{ $post->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @endif
                <img src="{{ $post->imagem_capa ?: asset('assets/images/placeholder-mar.svg') }}" alt="{{ $post->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <span class="absolute top-3 left-3 bg-[#17344D] text-white text-[10px] font-bold px-2.5 py-1 rounded uppercase">
                  {{ $post->categoria }}
                </span>
              </div>
              <div class="p-5 space-y-2">
                <span class="text-[11px] text-slate-400">
                  {{ $post->publicado_em ? $post->publicado_em->translatedFormat('d \d\e F, Y') : '' }}
                </span>
                <h3 class="font-title font-bold text-base text-[#17344D] hover:text-[#C6282D] transition-colors leading-snug">
                  <a href="{{ route('noticia.show', $post->slug) }}">
                    {{ $post->titulo }}
                  </a>
                </h3>
                <p class="text-xs text-slate-600 line-clamp-3">
                  {{ $post->resumo }}
                </p>
              </div>
            </div>
            <div class="p-5 pt-0">
              <a href="{{ route('noticia.show', $post->slug) }}" class="text-xs font-bold text-[#17344D] hover:text-[#C6282D]">
                Continuar lendo →
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @elseif(!isset($featuredPost) || !$featuredPost)
      <div class="text-center py-16 text-slate-500">
        <i class="fa-regular fa-newspaper text-4xl mb-3 text-slate-300"></i>
        <p class="text-base font-semibold">Nenhuma notícia encontrada nesta categoria.</p>
        <a href="{{ route('noticias') }}" class="btn-primary-mar text-xs py-2 px-4 mt-4 inline-block">Ver todas as notícias</a>
      </div>
    @endif

  </div>
@endsection
