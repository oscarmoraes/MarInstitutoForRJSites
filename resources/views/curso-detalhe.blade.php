@extends('layouts.app')

@section('title', 'Simpósio Instituto MAR 2026 — Detalhes e Inscrição — Instituto MAR')

@section('content')
  <!-- BREADCRUMB NAV -->
  <div class="bg-[#17344D] text-white py-4 px-4 sm:px-6 lg:px-8 border-b border-slate-700 text-xs">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center gap-2 text-slate-300">
      <a href="{{ route('home') }}" class="hover:text-white"><i class="fa-solid fa-house mr-1"></i> Início</a>
      <span>/</span>
      <a href="{{ route('cursos') }}" class="hover:text-white">Cursos e Palestras</a>
      <span>/</span>
      <span class="text-white font-semibold truncate max-w-xs sm:max-w-md">Simpósio Instituto MAR 2026</span>
    </div>
  </div>

  <!-- HERO DO EVENTO -->
  <section class="bg-gradient-to-b from-[#17344D] to-[#0F2334] text-white py-12 sm:py-16 px-4 sm:px-6 md:px-8 relative overflow-hidden">
    <div class="max-w-7xl mx-auto space-y-6 relative z-10">
      
      <div class="flex flex-wrap items-center gap-3">
        <span class="bg-[#C6282D] text-white text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full inline-flex items-center gap-2 shadow-sm">
          <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span> INSCRIÇÕES ABERTAS
        </span>
        <span class="bg-white/10 text-slate-200 border border-white/15 text-xs font-semibold px-3 py-1.5 rounded-full">
          Formato {{ $event->formato ?? 'Híbrido' }}
        </span>
      </div>

      <h1 class="font-title font-extrabold text-2xl sm:text-4xl lg:text-5xl text-white leading-tight max-w-4xl">
        {{ $event->titulo }}
      </h1>

      <p class="text-slate-300 text-xs sm:text-base lg:text-lg max-w-3xl font-light leading-relaxed">
        {{ $event->descricao }}
      </p>

      <!-- BARRA DE DATAS E LOCAL -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-white/10 text-xs text-slate-300 max-w-4xl">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-red-400 text-sm shrink-0">
            <i class="fa-regular fa-calendar-check"></i>
          </div>
          <div>
            <div class="font-bold text-white">{{ $event->data_evento ? $event->data_evento->translatedFormat('d \d\e F, Y') : 'A definir' }}</div>
            <div class="text-[10px] text-slate-400">{{ $event->data_evento ? $event->data_evento->translatedFormat('l') : 'Em breve' }}</div>
          </div>
        </div>

        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-red-400 text-sm shrink-0">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div>
            <div class="font-bold text-white">{{ $event->data_evento ? $event->data_evento->format('H:i') . 'h' : '09:00' }}</div>
            <div class="text-[10px] text-slate-400">Carga: {{ $event->carga_horaria }}</div>
          </div>
        </div>

        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-red-400 text-sm shrink-0">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div>
            <div class="font-bold text-white">{{ $event->local }}</div>
            <div class="text-[10px] text-slate-400">Presença & Transmissão</div>
          </div>
        </div>

        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-red-400 text-sm shrink-0">
            <i class="fa-solid fa-award"></i>
          </div>
          <div>
            <div class="font-bold text-white">Certificado Oficial</div>
            <div class="text-[10px] text-slate-400">Emitido pelo Instituto MAR</div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- COLUNA ESQUERDA (DETALHES DO EVENTO) -->
      <div class="lg:col-span-8 space-y-12">
        
        <!-- SOBRE O EVENTO -->
        <section class="space-y-4">
          <h2 class="font-title font-extrabold text-xl sm:text-2xl text-[#17344D] border-b border-slate-200 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-circle-info text-[#C6282D]"></i> Sobre o Simpósio
          </h2>
          <div class="prose max-w-none text-slate-700 text-xs sm:text-base leading-relaxed space-y-4">
            <p>
              O <strong>Simpósio Instituto MAR — Advocacia Renovada 2026</strong> reúne os mais destacados nomes do Direito constitucional, processual e da advocacia privada para um dia inteiro de imersão técnica e estratégica.
            </p>
            <p>
              O objetivo do simpósio é fornecer pareceres práticos, estratégias de defesa de honorários e diretrizes éticas para a integração de ferramentas digitais e Inteligência Artificial na rotina jurídica dos escritórios.
            </p>
          </div>
        </section>

        <!-- PROGRAMAÇÃO OFICIAL -->
        <section class="space-y-6">
          <h2 class="font-title font-extrabold text-xl sm:text-2xl text-[#17344D] border-b border-slate-200 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-list-check text-[#C6282D]"></i> Programação Completa
          </h2>

          <div class="space-y-4">
            
            <!-- Painel 1 -->
            <div class="md-card p-5 space-y-3 border-l-4 border-l-[#17344D]">
              <div class="flex justify-between items-center text-xs font-bold text-[#17344D]">
                <span class="bg-slate-100 px-3 py-1 rounded-full"><i class="fa-regular fa-clock mr-1 text-[#C6282D]"></i> 09:00 - 10:30</span>
                <span class="text-slate-400 uppercase text-[10px]">Painel Abertura</span>
              </div>
              <h3 class="font-title font-bold text-base text-[#17344D]">
                Mesa de Abertura: O Papel Institucional da Advocacia na Defesa da Democracia
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Palestrantes: Dr. Carlos Eduardo Mendonça (Pres. MAR) & Convidado de Honra.
              </p>
            </div>

            <!-- Painel 2 -->
            <div class="md-card p-5 space-y-3 border-l-4 border-l-[#C6282D]">
              <div class="flex justify-between items-center text-xs font-bold text-[#17344D]">
                <span class="bg-slate-100 px-3 py-1 rounded-full"><i class="fa-regular fa-clock mr-1 text-[#C6282D]"></i> 10:45 - 12:30</span>
                <span class="text-slate-400 uppercase text-[10px]">Painel 02</span>
              </div>
              <h3 class="font-title font-bold text-base text-[#17344D]">
                Estratégias Práticas para Defesa e Fixação de Honorários de Sucumbência (Art. 85 do CPC)
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Palestrantes: Dra. Mariana Alencar Fonseca & Dra. Juliana Alvarenga.
              </p>
            </div>

            <!-- Painel 3 -->
            <div class="md-card p-5 space-y-3 border-l-4 border-l-[#17344D]">
              <div class="flex justify-between items-center text-xs font-bold text-[#17344D]">
                <span class="bg-slate-100 px-3 py-1 rounded-full"><i class="fa-regular fa-clock mr-1 text-[#C6282D]"></i> 14:00 - 16:00</span>
                <span class="text-slate-400 uppercase text-[10px]">Painel 03</span>
              </div>
              <h3 class="font-title font-bold text-base text-[#17344D]">
                Inteligência Artificial, Produtividade e os Limites Éticos na Advocacia Contemporânea
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Palestrantes: Dr. Lucas Vasconcelos & Especialistas em Direito Digital.
              </p>
            </div>

            <!-- Painel 4 -->
            <div class="md-card p-5 space-y-3 border-l-4 border-l-[#C6282D]">
              <div class="flex justify-between items-center text-xs font-bold text-[#17344D]">
                <span class="bg-slate-100 px-3 py-1 rounded-full"><i class="fa-regular fa-clock mr-1 text-[#C6282D]"></i> 16:30 - 18:00</span>
                <span class="text-slate-400 uppercase text-[10px]">Encerramento</span>
              </div>
              <h3 class="font-title font-bold text-base text-[#17344D]">
                Posse das Novas Coordenações Estaduais & Carta de Brasília 2026
              </h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Apresentação das diretrizes nacionais aprovadas durante o simpósio.
              </p>
            </div>

          </div>
        </section>

        <!-- PALESTRANTES CONFIRMADOS -->
        <section class="space-y-6">
          <h2 class="font-title font-extrabold text-xl sm:text-2xl text-[#17344D] border-b border-slate-200 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-users text-[#C6282D]"></i> Palestrantes de Destaque
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <div class="md-card p-5 flex items-center gap-4">
              <img src="{{ asset('assets/images/default-avatar.svg') }}" alt="Palestrante 1" class="w-16 h-16 rounded-xl object-cover border-2 border-[#17344D] shrink-0">
              <div>
                <h3 class="font-title font-bold text-sm text-[#17344D]">Dr. Carlos Eduardo Mendonça</h3>
                <p class="text-[11px] text-[#C6282D] font-semibold">Presidente Nacional MAR</p>
                <p class="text-[10px] text-slate-400">Constitucionalista e Parecerista</p>
              </div>
            </div>

            <div class="md-card p-5 flex items-center gap-4">
              <img src="{{ asset('assets/images/default-avatar.svg') }}" alt="Palestrante 2" class="w-16 h-16 rounded-xl object-cover border-2 border-[#17344D] shrink-0">
              <div>
                <h3 class="font-title font-bold text-sm text-[#17344D]">Dra. Mariana Alencar Fonseca</h3>
                <p class="text-[11px] text-[#C6282D] font-semibold">Vice-Presidente MAR</p>
                <p class="text-[10px] text-slate-400">Processualista e Autora</p>
              </div>
            </div>

          </div>
        </section>

        @if ($event->galleries->isNotEmpty())
          <section class="space-y-6">
            <h2 class="font-title font-extrabold text-xl sm:text-2xl text-[#17344D] border-b border-slate-200 pb-3 flex items-center gap-2">
              <i class="fa-solid fa-images text-[#C6282D]"></i> Galeria do Evento
            </h2>

            @foreach ($event->galleries as $gallery)
              @if ($gallery->photos->isNotEmpty())
                <div class="space-y-4">
                  <div>
                    <h3 class="font-title font-bold text-lg text-[#17344D]">{{ $gallery->title }}</h3>
                    @if ($gallery->description)
                      <p class="text-sm text-slate-600 mt-1">{{ $gallery->description }}</p>
                    @endif
                  </div>

                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($gallery->photos as $photo)
                      @php
                        $photoUrl = filter_var($photo->path, FILTER_VALIDATE_URL)
                            ? $photo->path
                            : asset('storage/' . ltrim($photo->path, '/'));
                      @endphp
                      <figure class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                        <img src="{{ $photoUrl }}" alt="{{ $photo->title ?: $gallery->title }}" loading="lazy" class="w-full aspect-[4/3] object-cover transition duration-300 group-hover:scale-105">
                        @if ($photo->title || $photo->description)
                          <figcaption class="p-3">
                            @if ($photo->title)
                              <div class="font-semibold text-sm text-[#17344D]">{{ $photo->title }}</div>
                            @endif
                            @if ($photo->description)
                              <p class="text-xs text-slate-500 mt-1">{{ $photo->description }}</p>
                            @endif
                          </figcaption>
                        @endif
                      </figure>
                    @endforeach
                  </div>
                </div>
              @endif
            @endforeach
          </section>
        @endif

      </div>

      <!-- SIDEBAR DIREITA (BOX DE INSCRIÇÃO STICKY) -->
       @if($event->data_evento && $event->data_evento->isFuture())
      <aside class="lg:col-span-4 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xl space-y-6 sticky top-24">
          
          <div class="text-center space-y-2 border-b border-slate-100 pb-4">
            <span class="badge-mar text-[10px] font-bold uppercase">INSCRIÇÃO GRATUITA</span>
            <div class="font-title font-extrabold text-2xl text-[#17344D]">Vagas Limitadas</div>
            <p class="text-xs text-slate-500">Simpósio exclusivo para advogados e bacharéis.</p>
          </div>

          <!-- BARRA DE PROGRESSO DE VAGAS -->
          @php
            $totalVagas = max($event->vagas_totais ?? 30, 1);
            $regCount = $registeredCount ?? 0;
            $percent = min(100, round(($regCount / $totalVagas) * 100));
            $restantes = max(0, $totalVagas - $regCount);
          @endphp
          <div class="space-y-2">
            <div class="flex justify-between text-xs font-bold text-[#17344D]">
              <span>Ocupação das Vagas:</span>
              <span class="text-[#C6282D]">{{ $regCount }} de {{ $totalVagas }} Vagas</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden border border-slate-200">
              <div class="bg-gradient-to-r from-[#17344D] to-[#C6282D] h-full rounded-full" style="width: {{ $percent }}%"></div>
            </div>
            <div class="text-[11px] text-slate-400 text-center">Restam apenas <strong class="text-[#C6282D]">{{ $restantes }} vagas</strong> disponíveis.</div>
          </div>

          <!-- BOTÃO DE AÇÃO PRINCIPAL -->
          <button onclick="openLeadModal()" class="btn-accent-mar w-full text-xs py-4 shadow-xl text-center">
            <i class="fa-solid fa-pen-to-square mr-1.5"></i> Inscrever-se Gratuitamente
          </button>

          <div class="space-y-2 pt-2 border-t border-slate-100 text-xs text-slate-600">
            <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-600"></i> Confirmação imediata via WhatsApp</div>
            <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-600"></i> Certificado de 10h incluso</div>
            <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-600"></i> Acesso à gravação aos associados</div>
          </div>

        </div>
      </aside>
      @endif

    </div>
  </div>

  <!-- MODAL DE INSCRIÇÃO AO VIVO -->
  <div id="modalLeadCapture" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[2000] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl relative border border-slate-200">
      <button onclick="closeLeadModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <div class="text-center space-y-2">
        <span class="badge-mar text-[10px] font-bold uppercase">CONFIRMAÇÃO DE VAGA</span>
        <h3 class="font-title font-bold text-xl text-[#17344D]">Simpósio Instituto MAR 2026</h3>
        <p class="text-xs text-slate-500">Informe seu Nome e WhatsApp com DDD.</p>
      </div>

      <livewire:event-registration-form :event-id="$event->id ?? 1" />
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openLeadModal() {
    const modal = document.getElementById('modalLeadCapture');
    if (modal) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  }

  function closeLeadModal() {
    const modal = document.getElementById('modalLeadCapture');
    if (modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventRegistrationForm');
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Parabéns! Sua vaga para o Simpósio MAR 2026 está garantida com sucesso!');
        closeLeadModal();
        form.reset();
      });
    }
  });
</script>
@endpush
