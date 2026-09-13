@extends('layouts.app')

@section('title', 'Diretoria e Comissões — Instituto MAR')

@section('content')
  <!-- BANNER DA PÁGINA -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">CORPO DIRECTIVO & COMISSÕES</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Liderança comprometida com o fortalecimento da advocacia.</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        O Instituto MAR é conduzido por advogados e juristas com reconhecida atuação profissional, comprometidos com a renovação ética, a representatividade e a valorização das prerrogativas.
      </p>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-12 sm:space-y-16 w-full flex-grow">

    <!-- SEÇÃO PRESIDÊNCIA & DIRETORIA EXECUTIVA -->
    <section class="space-y-8">
      <div class="border-b border-slate-200 pb-3">
        <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D]">Presidência & Diretoria Executiva</h2>
        <p class="text-xs text-slate-500 mt-1">Gestão Nacional 2025–2027</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($directors as $dir)
          <div class="md-card overflow-hidden flex flex-col justify-between">
            <div>
              <div class="h-60 sm:h-64 overflow-hidden relative bg-slate-900">
                <img src="{{ $dir->foto_url ?: asset('assets/images/default-avatar.svg') }}" alt="{{ $dir->nome }}" class="w-full h-full object-cover">
                @if($dir->uf)
                  <div class="absolute top-3 right-3 bg-[#17344D] text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">
                    {{ $dir->uf }}
                  </div>
                @endif
              </div>
              <div class="p-5 sm:p-6 space-y-3">
                <div>
                  <h3 class="font-title font-bold text-lg sm:text-xl text-[#17344D]">{{ $dir->nome }}</h3>
                  <p class="text-xs font-semibold text-[#C6282D]">{{ $dir->cargo }}</p>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                  {{ $dir->bio }}
                </p>
              </div>
            </div>
            @if($dir->oab)
              <div class="p-5 sm:p-6 pt-0 border-t border-slate-100 mt-2 flex flex-wrap gap-3 text-xs text-slate-500">
                <span><i class="fa-solid fa-id-card text-[#C6282D] mr-1"></i> OAB/{{ $dir->uf }} {{ $dir->oab }}</span>
              </div>
            @endif
          </div>
        @empty
          <div class="col-span-full p-8 text-center text-slate-500">
            Nenhum diretor cadastrado no momento.
          </div>
        @endforelse
      </div>
    </section>

    <!-- SEÇÃO COMISSÕES TEMÁTICAS -->
    <section class="space-y-8">
      <div class="border-b border-slate-200 pb-3">
        <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D]">Comissões Temáticas Nacionais</h2>
        <p class="text-xs text-slate-500 mt-1">Órgãos permanentes de estudo, pareceres e atuação especializada do Instituto MAR.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($commissions as $com)
          <div class="md-card p-6 space-y-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded bg-[#17344D] text-white flex items-center justify-center text-lg font-bold shrink-0">
                <i class="fa-solid fa-scale-balanced"></i>
              </div>
              <div>
                <h3 class="font-title font-bold text-base text-[#17344D]">{{ $com->cargo }}</h3>
                <span class="text-[11px] text-slate-500 font-medium">Presidente de Comissão: {{ $com->nome }} @if($com->uf)({{ $com->uf }})@endif</span>
              </div>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ $com->bio }}
            </p>
          </div>
        @empty
          <div class="col-span-full p-8 text-center text-slate-500">
            Nenhuma comissão temática cadastrada no momento.
          </div>
        @endforelse
      </div>
    </section>

  </div>
@endsection
