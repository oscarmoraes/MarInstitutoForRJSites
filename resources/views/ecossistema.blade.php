@extends('layouts.app')

@section('title', 'Ecossistema MAR do Futuro — Instituto MAR')

@section('content')
  {{-- HERO --}}
  <div class="relative flex min-h-[650px] items-center overflow-hidden bg-[#071e35] lg:min-h-[715px]">
      {{-- GRADIENTE DE FUNDO --}}
      <div class="absolute inset-0 bg-gradient-to-r from-[#061b30] via-[#102e4b] to-[#173d60]"></div>

      {{-- IMAGEM DECORATIVA --}}
      <div class="absolute inset-0">
          <img
              src="{{ asset('assets/images/mar-ecosystem.png') }}"
              alt=""
              class="h-full w-full object-cover object-center opacity-95"
          >
          <div class="absolute inset-0 bg-gradient-to-r from-[#071e35] via-[#071e35]/90 to-transparent"></div>
      </div>

      {{-- CONTEÚDO --}}
      <div class="relative z-10 mx-auto w-full max-w-[1160px] px-6 py-20 lg:px-0">

          <div class="max-w-[550px]">

              {{-- IDENTIFICAÇÃO --}}
              <span class="mb-8 block text-[11px] font-bold uppercase tracking-[1.5px] text-[#ff8d98]">
                  Instituto MAR / Visão de futuro
              </span>

              {{-- TÍTULO --}}
              <h1 class="text-[46px] font-bold leading-[1.08] tracking-[-2px] text-white sm:text-[60px] lg:text-[88px] lg:tracking-[-4px]">
                  A advocacia
                  <br>
                  cresce em
                  <br>
                  <span class="text-[#ff929c]">
                      ecossistema.
                  </span>
              </h1>

              {{-- DESCRIÇÃO --}}
              <p class="mt-7 max-w-[450px] text-[17px] leading-[1.8] text-white sm:text-[19px]">
                  Seu escritório conectado a mais conhecimento,
                  tecnologia e soluções para seus clientes.
              </p>

              {{-- BOTÕES --}}
              <div class="mt-8 flex flex-wrap items-center gap-7">

                  <a
                      href="#visao"
                      class="inline-flex h-[54px] items-center gap-8 bg-[#d3262e] px-6 text-[13px] font-bold text-white transition hover:bg-[#b51e26]"
                  >
                      Conheça o projeto
                      <span class="text-base">↗</span>
                  </a>

                  <a
                      href="#"
                      class="border-b border-white/60 pb-1 text-[12px] font-medium text-white transition hover:border-[#ff929c] hover:text-[#ff929c]"
                  >
                      Apresentação em PDF ↓
                  </a>

              </div>

              {{-- TEXTO INFERIOR --}}
              <p class="mt-11 max-w-[450px] text-[10px] leading-[1.8] text-white/90">
                  Esta é a proposta de evolução do Instituto MAR.
                  Os novos benefícios, programas e unidades serão
                  implantados por etapas.
              </p>

          </div>
      </div>

      {{-- IDENTIFICAÇÃO DA ARTE --}}
      <div class="absolute bottom-14 right-[6%] z-10 hidden text-[10px] font-medium uppercase leading-[1.7] tracking-[3px] text-white lg:block">
          MAR
          <br>
          DO FUTURO
      </div>
  </div>

  <nav aria-label="Nesta página" class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-3 flex gap-5 overflow-x-auto text-xs font-bold text-slate-600 whitespace-nowrap">
      <a href="#visao" class="hover:text-[#C6282D]">A visão</a>
      <a href="#ecossistema" class="hover:text-[#C6282D]">Ecossistema</a>
      <a href="#frentes" class="hover:text-[#C6282D]">Frentes de atuação</a>
      <a href="#jornada" class="hover:text-[#C6282D]">Na prática</a>
      <a href="#associado" class="hover:text-[#C6282D]">Ser associado</a>
      <a href="#servicos" class="hover:text-[#C6282D]">Serviços</a>
      <a href="#napratica" class="hover:text-[#C6282D]">Na prática</a>
      <a href="#modeloeconomico" class="hover:text-[#C6282D]">Modelo econômico</a>
      <a href="#simulacao" class="hover:text-[#C6282D]">Simulador de receita</a>
      <a href="#mar-inteligencia" class="hover:text-[#C6282D]">MAR Inteligência</a>
      <a href="#duvidas" class="hover:text-[#C6282D]">Dúvidas</a>
    </div>
  </nav>

  @include('components.ecossistema.visao')

  @include('components.ecossistema.contexto')

  @include('components.ecossistema.ecossistema')

  @include('components.ecossistema.frentes')

  @include('components.ecossistema.associado')

  @include('components.ecossistema.servicos')

  @include('components.ecossistema.napratica')

  @include('components.ecossistema.modeloeconomico')

  @include('components.ecossistema.simulador')

  @include('components.ecossistema.mar-inteligencia')

  @include('components.ecossistema.conhecimento-impacto')
  
  </div>
@endsection
