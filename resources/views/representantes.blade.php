@extends('layouts.app')

@section('title', 'Representantes nos Estados — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">CAPILARIDADE NACIONAL</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">MAR no seu Estado</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Encontre os representantes e coordenadores regionais do Instituto MAR. Nossa presença capilar assegura suporte direto e acolhimento das demandas dos advogados em todo o Brasil.
      </p>
    </div>
  </section>

  <!-- ÁREA DE FILTRO E CARDS -->
  <div class="py-10 sm:py-12 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow space-y-8">

    <div class="bg-white p-5 sm:p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
      <div class="w-full md:w-auto">
        <form method="GET" action="{{ route('representantes') }}" id="uf-form">
          <label for="select-uf-filter" class="block text-xs font-bold text-[#17344D] uppercase tracking-wider mb-2">Selecione o Estado (UF):</label>
          <select id="select-uf-filter" name="uf" onchange="this.form.submit()" class="w-full md:w-64 p-3 bg-slate-50 border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#17344D]">
            <option value="TODOS">Todos os Estados (Exibindo Todos)</option>
            @foreach($ufs as $uf)
              <option value="{{ $uf }}" {{ ($selectedUf ?? '') === $uf ? 'selected' : '' }}>
                {{ $uf }}
              </option>
            @endforeach
          </select>
        </form>
      </div>

      <div class="text-xs text-slate-500 text-center md:text-right">
        Exibindo {{ $representatives->count() }} {{ $representatives->count() === 1 ? 'representante cadastrado' : 'representantes cadastrados' }}.
      </div>
    </div>

    <!-- GRID COMPLETO DE REPRESENTANTES -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      @forelse($representatives as $rep)
        <div class="md-card p-5 sm:p-6 flex flex-col justify-between space-y-4">
          <div class="flex items-start gap-3.5">
            <img src="{{ $rep->foto_url ?: asset('assets/images/default-avatar.svg') }}" alt="{{ $rep->nome }}" class="w-16 sm:w-20 h-16 sm:h-20 rounded-xl object-cover shrink-0 border-2 border-[#17344D]">
            <div>
              <span class="badge-navy text-[10px]">{{ $rep->state->letter }} {{ $rep->categoria !="" ? " - " . $rep->categoria : "" }}</span>
              
              <h3 class="font-title font-bold text-base sm:text-lg text-[#17344D] mt-1">{{ $rep->nome }}</h3>
              <p class="text-xs font-semibold text-[#C6282D]">{{ $rep->cargo }}</p>
              @if($rep->oab)
                <p class="text-[10px] text-slate-400">OAB/{{ $rep->state->letter }} {{ $rep->oab }}</p>
              @endif
            </div>
          </div>
          <p class="text-xs text-slate-600 leading-relaxed">
            {{ $rep->bio }}
          </p>
          <div class="pt-3 border-t border-slate-100 flex justify-between items-center text-xs">
            <span class="text-slate-500"><i class="fa-solid fa-location-dot text-[#C6282D] mr-1"></i> {{ $rep->categoria !="" ? $rep->categoria . " - ": "" }} {{ $rep->state->letter }}</span>
            <a href="mailto:{{ strtolower($rep->email) }}" class="font-bold text-[#17344D] hover:underline"><i class="fa-solid fa-envelope mr-1"></i> Contato</a>
          </div>
        </div>
      @empty
        <div class="col-span-full p-12 text-center text-slate-500">
          Nenhum representante cadastrado para o estado selecionado.
        </div>
      @endforelse
    </div>

  </div>
@endsection
