@extends('layouts.app')

@section('title', 'Plantão Emergencial de Prerrogativas 24h — Instituto MAR')

@section('content')
  <!-- HERO E ALERTA URGENTE 24H -->
  <section class="bg-[#17344D] text-white py-12 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700 relative overflow-hidden">
    <div class="max-w-7xl mx-auto space-y-4 text-center sm:text-left relative z-10">
      <div class="inline-flex items-center gap-2 bg-[#C6282D] text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider animate-pulse">
        <i class="fa-solid fa-shield-halved"></i> PLANTÃO EMERGENCIAL 24H — ATENDIMENTO EM TODO O BRASIL
      </div>
      <h1 class="font-title text-2xl sm:text-4xl md:text-5xl font-extrabold text-white">
        Defesa Incondicional das Prerrogativas da Advocacia
      </h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Não há hierarquia nem subordinação entre advogados, magistrados e membros do Ministério Público. Se as suas prerrogativas profissionais forem violadas ou ameaçadas no exercício da profissão, acione o Instituto MAR imediatamente.
      </p>
    </div>
  </section>

  <!-- BANNER DE ACIONAMENTO RÁPIDO (HOTLINE 24H) -->
  <div class="bg-[#C6282D] text-white py-4 px-4 sm:px-8 shadow-md">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-2xl">
          <i class="fa-solid fa-phone-volume"></i>
        </div>
        <div>
          <h3 class="font-title font-bold text-sm sm:text-base">Acionamento Urgente / Prisão ou Impedimento no Exercício</h3>
          <p class="text-xs text-red-100">Disque Plantão Prerrogativas 24h: <a href="tel:08007779000" class="font-bold underline hover:text-white">0800 777 9000</a> ou WhatsApp <a href="https://wa.me/5561999990000?text=Acionamento+Urgente+de+Prerrogativas+-+Instituto+MAR" target="_blank" rel="noopener noreferrer" class="font-bold underline hover:text-white">(61) 99999-0000</a></p>
        </div>
      </div>
      <a href="#formDenuncia" class="bg-white text-[#C6282D] hover:bg-red-50 font-bold px-6 py-2.5 rounded-xl text-xs shadow-lg uppercase transition-all whitespace-nowrap">
        <i class="fa-solid fa-file-shield mr-1.5"></i> Registrar Denúncia On-line
      </a>
    </div>
  </div>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow space-y-16">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- FORMULÁRIO DE DENÚNCIA -->
      <div id="formDenuncia" class="lg:col-span-8 bg-white p-6 sm:p-10 rounded-2xl border border-slate-200 shadow-xl space-y-6">
        <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
          <div>
            <span class="badge-mar text-[10px] font-bold uppercase">CANAL OFICIAL DE VIOLAÇÃO</span>
            <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D] mt-1">Formulário de Assistência às Prerrogativas</h2>
            <p class="text-xs text-slate-500">As informações prestadas são protegidas por sigilo institucional.</p>
          </div>
          <i class="fa-solid fa-scale-balanced text-3xl text-slate-200 hidden sm:block"></i>
        </div>

        <livewire:prerogative-form />
      </div>

      <!-- PAINEL LATERAL: DIREITOS FUNDAMENTAIS & CARTILHA -->
      <div class="lg:col-span-4 space-y-6">
        
        <!-- RESUMO DIREITOS LEI 8.906/94 (EAOAB) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
          <h3 class="font-title font-bold text-base text-[#17344D] border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-gavel text-[#C6282D]"></i> Direitos da Advocacia (Art. 7º, EAOAB)
          </h3>

          <div class="space-y-3 text-xs text-slate-600">
            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#C6282D]">
              <h4 class="font-bold text-[#17344D]">Livre Exercício da Profissão</h4>
              <p class="text-[11px]">Exercer, com liberdade, a profissão em todo o território nacional (Art. 7º, I).</p>
            </div>

            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#17344D]">
              <h4 class="font-bold text-[#17344D]">Inviolabilidade do Escritório</h4>
              <p class="text-[11px]">Inviolabilidade do escritório ou local de trabalho, de seus arquivos e dados (Art. 7º, II).</p>
            </div>

            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#C6282D]">
              <h4 class="font-bold text-[#17344D]">Acesso a Autos de Inquéritos</h4>
              <p class="text-[11px]">Examinar, em qualquer órgão, autos de flagrante e de investigações, findos ou em andamento (Art. 7º, XIV).</p>
            </div>

            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#17344D]">
              <h4 class="font-bold text-[#17344D]">Comunicação Pessoal e Reservada</h4>
              <p class="text-[11px]">Comunicar-se com seus clientes, pessoal e reservadamente, mesmo sem procuração, quando presos (Art. 7º, III).</p>
            </div>
          </div>
        </div>

        <!-- TELEFONES E ATENDIMENTO PRESENCIAL -->
        <div class="bg-[#17344D] text-white p-6 rounded-2xl shadow-lg space-y-4">
          <h3 class="font-title font-bold text-base text-white border-b border-slate-700 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-headset text-red-400"></i> Plantão de Urgência
          </h3>

          <div class="space-y-3 text-xs">
            <p class="text-slate-300">Em situações extremas envolvendo prisão em flagrante ou busca e apreensão, contate a comissão via ligação direta:</p>
            <div class="p-3 bg-white/10 rounded-lg space-y-1">
              <span class="text-[10px] uppercase font-bold text-red-300">Telefone 24 Horas:</span>
              <p class="font-bold text-sm text-white">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings->telefone_plantao ?? '08007779000') }}" class="hover:text-red-300 transition-colors">{{ $siteSettings->telefone_plantao ?? '0800 777 9000' }}</a>
              </p>
            </div>
            <div class="p-3 bg-white/10 rounded-lg space-y-1">
              <span class="text-[10px] uppercase font-bold text-red-300">WhatsApp Plantão:</span>
              <p class="font-bold text-sm text-white">
                <a href="https://wa.me/55{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_plantao ?? '61999990000') }}?text=Acionamento+Urgente+de+Prerrogativas+-+Instituto+MAR" target="_blank" rel="noopener noreferrer" class="hover:text-red-300 transition-colors">{{ $siteSettings->whatsapp_plantao ?? '(61) 99999-0000' }}</a>
              </p>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
@endsection

