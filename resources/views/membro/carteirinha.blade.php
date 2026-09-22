@extends('layouts.app')

@section('title', 'Carteirinha Digital do Associado — Instituto MAR')

@section('content')
  <!-- ESTILOS EXCLUSIVOS DE IMPRESSÃO (CARTEIRINHA) -->
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      #carteirinha-card, #carteirinha-card * {
        visibility: visible;
      }
      #carteirinha-card {
        position: absolute;
        left: 50%;
        top: 20%;
        transform: translate(-50%, -20%);
        box-shadow: none !important;
        border: 1px solid #17344D !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
      header, footer, #search-section, #actions-section, #benefits-section, #drawer, .mobile-drawer-backdrop {
        display: none !important;
      }
    }
  </style>

  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-12 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">ÁREA DO MEMBRO</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Carteirinha Digital do Associado</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Sua credencial oficial de identificação institucional do Movimento da Advocacia Renovada (MAR).
      </p>
    </div>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="py-10 sm:py-14 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow space-y-8">
    
    <!-- BARRA DE CONSULTA DE CARTEIRINHA -->
    <div id="search-section" class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-sm space-y-2">
      <label for="input-busca" class="block text-xs font-bold text-[#17344D] uppercase tracking-wider">
        Consultar Credencial Institucional:
      </label>
      <form method="GET" action="{{ route('membro.carteirinha') }}" class="flex flex-col sm:flex-row gap-3 items-center">
        <div class="relative flex-grow w-full">
          <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
          <input 
            type="text" 
            id="input-busca"
            name="busca" 
            value="{{ $search ?? '' }}" 
            placeholder="Digite Matrícula (ex: #2026-9842), CPF, Nº OAB ou Nome do Advogado..." 
            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-medium text-[#17344D] outline-none focus:border-[#17344D] focus:bg-white transition-all shadow-inner"
          >
        </div>
        <button type="submit" class="w-full sm:w-auto btn-primary-mar text-xs py-4 px-6 shadow-md whitespace-nowrap flex items-center justify-center gap-2">
          <i class="fa-solid fa-id-card"></i> Consultar Credencial
        </button>
      </form>
    </div>

    @if($searched && !$member)
      <!-- RESULTADO NÃO ENCONTRADO -->
      <div class="p-8 sm:p-12 bg-white rounded-2xl border border-slate-200 shadow-sm text-center space-y-4 max-w-2xl mx-auto">
        <div class="w-16 h-16 rounded-full bg-red-100 text-[#C6282D] flex items-center justify-center text-2xl mx-auto">
          <i class="fa-solid fa-user-slash"></i>
        </div>
        <h3 class="font-title font-bold text-xl text-[#17344D]">Nenhum associado localizado</h3>
        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
          Não localizamos nenhum cadastro com o termo <strong>"{{ $search }}"</strong>. Verifique o número da matrícula, CPF ou OAB digitado.
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
          <a href="{{ route('membro.carteirinha') }}" class="btn-secondary-mar text-xs py-2.5 px-5">
            <i class="fa-solid fa-rotate-left mr-1"></i> Limpar Consulta
          </a>
          <a href="{{ route('associar') }}" class="btn-accent-mar text-xs py-2.5 px-5">
            <i class="fa-solid fa-user-plus mr-1"></i> Quero me Associar
          </a>
        </div>
      </div>
    @elseif($member)
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <!-- CARTÃO DIGITAL VIRTUAL -->
        <div class="lg:col-span-6 flex flex-col items-center justify-center space-y-6">
          
          <!-- CARD FRENTE (CREDANCIAL MAR) -->
          <div id="carteirinha-card" class="w-full max-w-md bg-gradient-to-br from-[#17344D] via-[#1E4363] to-[#0F2436] text-white rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden border border-amber-500/30">
            
            <!-- MARCA D'ÁGUA DE SEGURANÇA -->
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
              <i class="fa-solid fa-scale-balanced text-9xl"></i>
            </div>

            <!-- CABEÇALHO DA CARTEIRINHA -->
            <div class="flex justify-between items-center border-b border-white/10 pb-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white p-1.5 shadow-md flex items-center justify-center">
                  <img src="{{ asset('assets/images/logo-mar.png') }}" alt="Instituto MAR" class="h-full w-auto object-contain">
                </div>
                <div>
                  <h3 class="font-title font-extrabold text-xs uppercase tracking-wider text-white">Instituto MAR</h3>
                  <p class="text-[10px] text-slate-300">Advocacia Renovada</p>
                </div>
              </div>

              @if($member->status === 'ATIVO')
                <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-400/40 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span> ATIVO
                </span>
              @elseif($member->status === 'PENDENTE')
                <span class="bg-amber-500/20 text-amber-300 border border-amber-400/40 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1">
                  <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> EM ANÁLISE
                </span>
              @else
                <span class="bg-red-500/20 text-red-300 border border-red-400/40 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                  SUSPENSO
                </span>
              @endif
            </div>

            <!-- CORPO DA CARTEIRINHA: FOTO E DADOS -->
            <div class="mt-6 flex gap-5 items-center">
              
              <!-- FOTO DO ADVOGADO -->
              <div class="w-24 h-28 rounded-xl bg-slate-800 border-2 border-amber-400/60 overflow-hidden shrink-0 shadow-lg relative">
                <img src="{{ $member->foto_url ?: asset('assets/images/default-avatar.svg') }}" alt="{{ $member->nome }}" class="w-full h-full object-cover">
                <div class="absolute bottom-0 inset-x-0 bg-black/60 text-[8px] text-center text-amber-300 py-0.5 font-mono">
                  MAR-OAB
                </div>
              </div>

              <!-- DADOS DO ASSOCIADO -->
              <div class="space-y-1.5 text-xs">
                <div>
                  <span class="text-[9px] uppercase tracking-wider text-slate-400 block font-semibold">Nome do Associado</span>
                  <h4 class="font-title font-bold text-sm text-white truncate max-w-[200px]" title="{{ $member->nome }}">{{ $member->nome }}</h4>
                </div>

                <div class="grid grid-cols-2 gap-2 text-[11px]">
                  <div>
                    <span class="text-[9px] uppercase tracking-wider text-slate-400 block">Nº OAB</span>
                    <span class="font-bold text-amber-300">{{ $member->oab }} / {{ $member->uf }}</span>
                  </div>
                  <div>
                    <span class="text-[9px] uppercase tracking-wider text-slate-400 block">Matrícula MAR</span>
                    <span class="font-mono text-slate-200">{{ $member->matricula }}</span>
                  </div>
                </div>

                <div>
                  <span class="text-[9px] uppercase tracking-wider text-slate-400 block">Categoria</span>
                  <span class="font-semibold text-xs text-white">{{ $member->categoria ?? 'Advogado Efetivo' }}</span>
                </div>
              </div>

            </div>

            <!-- RODAPÉ DA CARTEIRINHA COM QR CODE E VALIDADE -->
            <div class="mt-6 pt-4 border-t border-white/10 flex justify-between items-center">
              <div>
                <span class="text-[8px] uppercase text-slate-400 block">Validade da Credencial</span>
                <span class="text-xs font-bold text-slate-200">
                  {{ $member->validade ? \Carbon\Carbon::parse($member->validade)->format('d/m/Y') : '31/12/2026' }}
                </span>
              </div>

              <!-- QR CODE DE AUTENTICIDADE -->
              <div class="flex items-center gap-2 bg-white/10 p-1.5 rounded-lg border border-white/20">
                <div class="w-8 h-8 bg-white p-1 rounded flex items-center justify-center">
                  <i class="fa-solid fa-qrcode text-xl text-[#17344D]"></i>
                </div>
                <div class="text-[8px] font-mono text-slate-300">
                  <span>HASH: {{ $member->hash_validacao ?? 'A9F2-2026' }}</span>
                </div>
              </div>
            </div>

          </div>

          <!-- AÇÕES DA CARTEIRINHA -->
          <div id="actions-section" class="w-full max-w-md flex flex-col sm:flex-row gap-3">
            <button onclick="window.print()" class="flex-1 btn-primary-mar text-xs py-3 shadow-md flex items-center justify-center gap-1.5">
              <i class="fa-solid fa-print text-[#C6282D]"></i> Imprimir Credencial
            </button>
            <button onclick="copyValidator('{{ $member->hash_validacao ?? $member->matricula }}')" class="flex-1 bg-slate-200 hover:bg-slate-300 text-[#17344D] font-bold text-xs py-3 rounded-xl transition-all flex items-center justify-center gap-1.5">
              <i class="fa-solid fa-copy"></i> Copiar Validador
            </button>
          </div>

          <div id="copy-toast" class="hidden text-xs bg-slate-800 text-white py-1.5 px-3 rounded-lg shadow-md transition-all">
            Código copiado com sucesso!
          </div>

        </div>

        <!-- PAINEL DE BENEFÍCIOS E AUTENTICIDADE DO MEMBRO -->
        <div id="benefits-section" class="lg:col-span-6 space-y-6">
          
          <!-- PAINEL STATUS DA ANUIDADE / MEMBRESIA -->
          <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-md space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 class="font-title font-extrabold text-lg text-[#17344D] flex items-center gap-2">
                <i class="fa-solid fa-id-badge text-[#C6282D]"></i> Status da Filiação Institucional
              </h3>
              @if($member->status === 'ATIVO')
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">REGULAR</span>
              @elseif($member->status === 'PENDENTE')
                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full">EM ANÁLISE</span>
              @else
                <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">SUSPENSO</span>
              @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
              <div class="p-3 bg-slate-50 rounded-xl space-y-1">
                <span class="text-slate-400 font-semibold block">Data de Filiação</span>
                <p class="font-bold text-[#17344D]">
                  {{ $member->created_at ? $member->created_at->translatedFormat('d \d\e F \d\e Y') : '15 de Janeiro de 2024' }}
                </p>
              </div>
              <div class="p-3 bg-slate-50 rounded-xl space-y-1">
                <span class="text-slate-400 font-semibold block">Comissão Integrante</span>
                <p class="font-bold text-[#17344D]">{{ $member->comissao ?? 'Direito Geral & Prerrogativas' }}</p>
              </div>
            </div>

            <div class="p-4 bg-blue-50 border border-blue-200 text-blue-900 rounded-xl text-xs space-y-1">
              <div class="font-bold flex items-center gap-1.5">
                <i class="fa-solid fa-circle-check text-blue-600"></i> Credencial Digital Válida em Todo o País
              </div>
              <p class="text-blue-700">
                Esta carteirinha digital garante desconto exclusivo de 50% em eventos do Instituto MAR e acesso prioritário ao Canal Emergencial de Prerrogativas 24h.
              </p>
            </div>
          </div>

          <!-- RECURSOS DO ASSOCIADO -->
          <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="font-title font-bold text-base text-[#17344D] border-b border-slate-100 pb-3">
              Serviços Exclusivos da Área do Membro
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
              <a href="{{ route('certificados.validar') }}" class="p-3 border border-slate-200 rounded-xl hover:border-[#17344D] hover:bg-slate-50 transition-all block space-y-1">
                <div class="font-bold text-[#17344D] flex items-center gap-1.5">
                  <i class="fa-solid fa-certificate text-[#C6282D]"></i> Validar Certificados
                </div>
                <p class="text-slate-500 text-[11px]">Emitir e validar certificados de cursos e palestras.</p>
              </a>

              <a href="{{ route('prerrogativas') }}" class="p-3 border border-slate-200 rounded-xl hover:border-[#C6282D] hover:bg-red-50 transition-all block space-y-1">
                <div class="font-bold text-[#C6282D] flex items-center gap-1.5">
                  <i class="fa-solid fa-shield-halved"></i> Acionar Plantão 24h
                </div>
                <p class="text-slate-500 text-[11px]">Abrir chamado de violação de prerrogativas.</p>
              </a>
            </div>
          </div>

        </div>

      </div>
    @endif

  </div>
@endsection

@push('scripts')
<script>
  function copyValidator(code) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(code).then(() => {
        showToast();
      });
    } else {
      showToast();
    }
  }

  function showToast() {
    const toast = document.getElementById('copy-toast');
    if (toast) {
      toast.classList.remove('hidden');
      setTimeout(() => {
        toast.classList.add('hidden');
      }, 3000);
    }
  }
</script>
@endpush
