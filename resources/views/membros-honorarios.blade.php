@extends('layouts.app')

@section('title', 'Membros Honorários — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">GALERIA SOLEME & RECONHECIMENTO</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Membros Honorários</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Juristas, mestres e defensores das garantias fundamentais cujas trajetórias e contribuições para o Direito brasileiro são homenageadas permanentemente pelo Instituto MAR.
      </p>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-12 sm:space-y-16 w-full flex-grow">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @forelse($honoraryMembers as $hon)
        <div class="md-card p-6 sm:p-8 flex flex-col sm:flex-row gap-6 items-center sm:items-start border-l-4 border-l-[#C6282D]">
          <img src="{{ $hon->foto_url ?: asset('assets/images/default-avatar.svg') }}" alt="{{ $hon->nome }}" class="w-28 sm:w-32 h-28 sm:h-32 rounded-2xl object-cover border-2 border-[#17344D] shrink-0">
          <div class="space-y-3 text-center sm:text-left flex-grow">
            <div>
              <span class="badge-navy text-[10px]">
                {{ $hon->oab ? $hon->oab : 'Membro Honorário' }} @if($hon->uf)• {{ $hon->uf }}@endif
              </span>
              <h2 class="font-title font-bold text-xl text-[#17344D] mt-1">{{ $hon->nome }}</h2>
              <p class="text-xs font-semibold text-[#C6282D]">{{ $hon->cargo }}</p>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ $hon->bio }}
            </p>
          </div>
        </div>
      @empty
        <div class="col-span-full p-12 text-center text-slate-500">
          Nenhum membro honorário cadastrado no momento.
        </div>
      @endforelse
    </div>

  </div>
@endsection
