@extends('layouts.app')

@section('title', 'Página Não Encontrada (404) — Instituto MAR')

@section('content')
  <div class="py-20 px-4 text-center max-w-3xl mx-auto space-y-6">
    <div class="w-24 h-24 bg-red-100 text-[#C6282D] rounded-full mx-auto flex items-center justify-center text-4xl shadow-inner">
      <i class="fa-solid fa-scale-unbalanced"></i>
    </div>
    
    <span class="badge-mar text-xs font-bold uppercase tracking-widest">ERRO 404 — PÁGINA NÃO ENCONTRADA</span>
    
    <h1 class="font-title text-3xl sm:text-5xl font-extrabold text-[#17344D]">
      Esta petição ou documento não foi localizado
    </h1>
    
    <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
      O endereço digitado pode ter sido alterado ou a página não existe mais no portal do Instituto MAR.
    </p>

    <div class="pt-4 flex flex-col sm:flex-row justify-center gap-4">
      <a href="{{ route('home') }}" class="btn-primary-mar text-xs py-3.5 px-6 shadow-md">
        <i class="fa-solid fa-house mr-1.5"></i> Voltar à Página Inicial
      </a>
      <a href="{{ route('contato') }}" class="bg-slate-200 hover:bg-slate-300 text-[#17344D] font-bold text-xs py-3.5 px-6 rounded-xl transition-all">
        <i class="fa-solid fa-headset mr-1.5"></i> Fale com o Atendimento
      </a>
    </div>
  </div>
@endsection
