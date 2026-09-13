@extends('layouts.app')

@section('title', 'Validador de Certificados Oficiais — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-12 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">AUTENTICIDADE E TRANSPARÊNCIA</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Validação de Certificados</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Verifique a autenticidade e validade jurídica de certificados emitidos pelo Movimento da Advocacia Renovada (MAR).
      </p>
    </div>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow space-y-12">
    
    <div class="max-w-3xl mx-auto bg-white p-6 sm:p-10 rounded-2xl border border-slate-200 shadow-xl space-y-6">
      <div class="text-center space-y-2">
        <div class="w-12 h-12 rounded-2xl bg-slate-100 text-[#17344D] mx-auto flex items-center justify-center text-xl">
          <i class="fa-solid fa-certificate"></i>
        </div>
        <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D]">Consultar Código de Autenticidade</h2>
        <p class="text-xs text-slate-500">Insira o código alfanumérico localizado no verso ou rodapé do certificado (Ex: MAR-2026-98421).</p>
      </div>

      <livewire:certificate-validator :codigo="request('codigo')" />
    </div>

  </div>
@endsection
