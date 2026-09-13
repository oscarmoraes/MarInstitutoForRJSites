@extends('layouts.app')

@section('title', 'Cursos e Palestras — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">FORMAÇÃO CONTINUADA</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Cursos, Palestras e Simpósios</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Capacitação técnica de alto nível, debates sobre inovação no Direito e simpósios regionais promovidos pelo Instituto MAR.
      </p>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-12 w-full flex-grow">

    @if(isset($featuredEvent) && $featuredEvent)
      <!-- SIMPÓSIO EM DESTAQUE COM INSCRIÇÃO AO VIVO -->
      <div class="bg-gradient-to-r from-[#17344D] via-[#0F2334] to-[#17344D] text-white rounded-2xl p-6 sm:p-10 shadow-xl border border-white/10 relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
          <div class="lg:col-span-8 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-600/30 border border-red-500/30 text-red-300 text-[10px] sm:text-xs font-bold uppercase rounded-full">
              <span class="w-2 h-2 rounded-full bg-[#C6282D] animate-pulse"></span> INSCRIÇÕES ABERTAS
            </div>
            <h2 class="font-title text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight">
              {{ $featuredEvent->titulo }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light">
              {{ $featuredEvent->descricao }}
            </p>
            <div class="flex flex-wrap gap-4 text-xs text-slate-300 pt-2">
              <span><i class="fa-regular fa-calendar-check text-[#C6282D] mr-1"></i> {{ $featuredEvent->data_evento ? $featuredEvent->data_evento->translatedFormat('d \d\e F, Y') : '' }}</span>
              <span><i class="fa-solid fa-clock text-[#C6282D] mr-1"></i> {{ $featuredEvent->data_evento ? $featuredEvent->data_evento->format('H:i') . 'h' : '09:00' }}</span>
              <span><i class="fa-solid fa-users text-[#C6282D] mr-1"></i> Formato {{ $featuredEvent->formato }}</span>
            </div>
          </div>

          <div class="lg:col-span-4 bg-white/10 p-6 rounded-xl border border-white/15 backdrop-blur-md text-center space-y-4">
            <div class="text-xs uppercase font-bold text-slate-300 tracking-wider">Garanta sua Vaga</div>
            <div class="text-3xl font-extrabold text-white font-title">{{ $featuredEvent->vagas_totais }} Vagas Totais</div>
            <p class="text-[11px] text-slate-300">Inscrição gratuita para advogados e estudantes de Direito cadastrados.</p>
            <div class="space-y-2">
              <a href="{{ route('curso.show', $featuredEvent->slug) }}" class="btn-primary-mar bg-white text-[#17344D] hover:bg-slate-100 font-bold w-full text-xs py-3 block shadow-md">
                <i class="fa-solid fa-circle-info mr-1"></i> Ver Detalhes da Programação
              </a>
              <button onclick="openLeadModal({{ $featuredEvent->id }}, '{{ addslashes($featuredEvent->titulo) }}')" class="btn-accent-mar w-full text-xs py-3 shadow-lg">
                <i class="fa-solid fa-pen-to-square mr-1"></i> Inscrever-se Agora
              </button>
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- GRID DE CURSOS E EVENTOS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
      @forelse($events as $event)
        <div class="md-card overflow-hidden flex flex-col justify-between group">
          <div>
            <div class="bg-[#17344D] text-white p-3.5 flex justify-between items-center text-xs font-bold">
              <span><i class="fa-regular fa-calendar-check mr-1.5 text-red-400"></i> {{ $event->data_evento ? $event->data_evento->translatedFormat('d M, Y') : '' }}</span>
              <span class="bg-white/20 px-2 py-0.5 rounded text-[10px] uppercase">{{ $event->formato }}</span>
            </div>
            <div class="p-5 space-y-2.5">
              <span class="badge-navy text-[10px]">{{ $event->carga_horaria }}</span>
              <h3 class="font-title font-bold text-base text-[#17344D] group-hover:text-[#C6282D] transition-colors leading-snug">
                <a href="{{ route('curso.show', $event->slug) }}">
                  {{ $event->titulo }}
                </a>
              </h3>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">{{ $event->descricao }}</p>
            </div>
          </div>
          <div class="p-5 pt-0 border-t border-slate-100 mt-3 flex justify-between items-center text-xs">
            <span class="text-slate-500 truncate max-w-[150px]"><i class="fa-solid fa-location-dot text-[#C6282D] mr-1"></i> {{ $event->local }}</span>
            <button onclick="openLeadModal({{ $event->id }}, '{{ addslashes($event->titulo) }}')" class="font-bold text-[#17344D] hover:text-[#C6282D]">Garantir Vaga →</button>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-12 text-slate-500">
          Nenhum outro evento agendado no momento.
        </div>
      @endforelse
    </div>

  </div>

  <!-- MODAL DE INSCRIÇÃO EM EVENTOS -->
  <div id="modalLeadCapture" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[2000] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl relative border border-slate-200">
      <button onclick="closeLeadModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 text-lg">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <div class="text-center space-y-2">
        <span class="badge-mar text-[10px] font-bold uppercase">INSCRIÇÃO INSTITUCIONAL</span>
        <h3 id="modalEventTitle" class="font-title font-bold text-xl text-[#17344D]">Inscreva-se no Evento</h3>
        <p class="text-xs text-slate-500">Preencha seus dados para garantir sua vaga.</p>
      </div>

      <form id="eventRegistrationForm" class="space-y-4">
        @csrf
        <input type="hidden" id="event_id" name="event_id" value="">
        
        <div>
          <label for="userName" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nome Completo *</label>
          <input type="text" id="userName" name="nome" required placeholder="Digite seu nome completo" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
        </div>

        <div>
          <label for="userPhone" class="block text-xs font-bold text-[#17344D] uppercase mb-1">WhatsApp (DDD) *</label>
          <input type="text" id="userPhone" name="whatsapp" required placeholder="(11) 99999-9999" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
        </div>

        <div>
          <label for="userEmail" class="block text-xs font-bold text-[#17344D] uppercase mb-1">E-mail</label>
          <input type="email" id="userEmail" name="email" placeholder="seuemail@exemplo.com" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
        </div>

        <div id="registrationMsg" class="hidden text-xs p-3 rounded-lg font-medium"></div>

        <button type="submit" id="btnSubmitRegistration" class="btn-accent-mar w-full text-xs py-3.5 shadow-md">
          <i class="fa-solid fa-check-circle mr-1"></i> Confirmar Minha Inscrição
        </button>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openLeadModal(id, title) {
    const modal = document.getElementById('modalLeadCapture');
    if (modal) {
      if (id) document.getElementById('event_id').value = id;
      if (title) document.getElementById('modalEventTitle').innerText = 'Inscreva-se em: ' + title;
      const msg = document.getElementById('registrationMsg');
      if (msg) msg.classList.add('hidden');
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
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitRegistration');
        const msg = document.getElementById('registrationMsg');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Processando...';

        try {
          const response = await fetch('{{ route('cursos.inscrever') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              event_id: document.getElementById('event_id').value,
              nome: document.getElementById('userName').value,
              whatsapp: document.getElementById('userPhone').value,
              email: document.getElementById('userEmail') ? document.getElementById('userEmail').value : ''
            })
          });

          const data = await response.json();
          if (response.ok && data.success) {
            msg.className = 'text-xs p-3 rounded-lg font-medium bg-emerald-50 text-emerald-800 border border-emerald-200 block';
            msg.innerText = data.message || 'Inscrição confirmada com sucesso!';
            form.reset();
            setTimeout(() => {
              closeLeadModal();
            }, 2000);
          } else {
            msg.className = 'text-xs p-3 rounded-lg font-medium bg-red-50 text-red-800 border border-red-200 block';
            msg.innerText = data.message || 'Erro ao processar inscrição. Verifique os dados e tente novamente.';
          }
        } catch (err) {
          msg.className = 'text-xs p-3 rounded-lg font-medium bg-red-50 text-red-800 border border-red-200 block';
          msg.innerText = 'Erro de conexão com o servidor. Tente novamente.';
        } finally {
          btn.disabled = false;
          btn.innerHTML = '<i class="fa-solid fa-check-circle mr-1"></i> Confirmar Minha Inscrição';
        }
      });
    }
  });
</script>
@endpush
