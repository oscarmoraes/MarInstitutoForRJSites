@extends('layouts.app')

@section('title', 'Instabilidade no Servidor (500) — Instituto MAR')

@section('content')
  <div class="py-20 px-4 text-center max-w-3xl mx-auto space-y-6">
    <div class="w-24 h-24 bg-amber-100 text-amber-700 rounded-full mx-auto flex items-center justify-center text-4xl shadow-inner">
      <i class="fa-solid fa-triangle-exclamation"></i>
    </div>
    
    <span class="badge-mar text-xs font-bold uppercase tracking-widest">ERRO 500 — INSTABILIDADE TEMPORÁRIA</span>
    
    <h1 class="font-title text-3xl sm:text-5xl font-extrabold text-[#17344D]">
      Falha Temporária no Servidor
    </h1>
    
    <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
      Nossa equipe técnica já foi notificada. Por favor, tente novamente em alguns instantes.
    </p>

    <div class="pt-4 flex justify-center">
      <a href="{{ route('home') }}" class="btn-primary-mar text-xs py-3.5 px-6 shadow-md">
        <i class="fa-solid fa-rotate-right mr-1.5"></i> Recarregar Portal
      </a>
    </div>
  </div>
@endsection
