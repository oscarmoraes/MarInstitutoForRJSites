@extends('layouts.app')

@section('title', 'Inscrição — ' . $event->titulo . ' | Instituto MAR')

@section('content')
  <section class="bg-gradient-to-b from-[#17344D] to-[#0F2334] text-white py-12 sm:py-16 px-4 sm:px-6 md:px-8">
    <div class="max-w-5xl mx-auto space-y-4">
      <a href="{{ route('curso.show', $event->slug) }}" class="inline-flex items-center gap-2 text-xs text-slate-300 hover:text-white">
        <i class="fa-solid fa-arrow-left"></i> Voltar aos detalhes do evento
      </a>
      <span class="block text-xs uppercase font-bold tracking-widest text-red-300">Inscrição no evento</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">{{ $event->titulo }}</h1>
      @if($event->subtitulo)
        <p class="text-slate-300 text-sm sm:text-base font-light leading-relaxed">{{ $event->subtitulo }}</p>
      @endif
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-xs text-slate-300 pt-2">
        <span><i class="fa-regular fa-calendar-check text-red-400 mr-1"></i>
          {{ $event->data_evento ? $event->data_evento->translatedFormat('d \d\e F, Y') : 'Data a definir' }}
        </span>
        @if($event->data_evento)
          <span><i class="fa-solid fa-clock text-red-400 mr-1"></i> {{ $event->data_evento->format('H:i') }}h</span>
        @endif
        @if($event->local)
          <span><i class="fa-solid fa-location-dot text-red-400 mr-1"></i> {{ $event->local }}</span>
        @endif
        @if($event->formato)
          <span><i class="fa-solid fa-users text-red-400 mr-1"></i> {{ $event->formato }}</span>
        @endif
      </div>
    </div>
  </section>

  <main class="py-10 sm:py-14 px-4 sm:px-6 md:px-8 max-w-5xl mx-auto w-full flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
      <section class="lg:col-span-3 space-y-4">
        <span class="badge-mar text-[10px] font-bold uppercase">Sobre o evento</span>
        @if($event->resumo)
          <p class="text-sm text-slate-600 leading-relaxed">{{ $event->resumo }}</p>
        @endif
        @if($event->descricao)
          <div class="prose max-w-none text-sm text-slate-600 leading-relaxed">
            {!! $event->descricao !!}
          </div>
        @endif
      </section>

      <section class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-xl p-6 sm:p-8">
        <div class="text-center space-y-2 mb-6">
          <span class="text-[10px] font-bold uppercase tracking-wider text-[#C6282D]">Inscrição gratuita</span>
          <h2 class="font-title text-xl font-extrabold text-[#17344D]">Garanta sua vaga</h2>
          <p class="text-xs text-slate-500">Preencha seus dados para confirmar sua participação.</p>
        </div>

        <form id="eventRegistrationForm" action="{{ route('cursos.inscrever') }}" method="POST" class="space-y-4">
          @csrf
          <input type="hidden" name="event_id" value="{{ $event->id }}">

          <div>
            <label for="registrationName" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nome completo *</label>
            <input id="registrationName" name="nome" type="text" required maxlength="255" autocomplete="name"
              class="w-full p-3 border border-slate-300 rounded-lg text-sm outline-none focus:border-[#17344D]"
              placeholder="Seu nome completo">
            <p data-error-for="nome" class="hidden mt-1 text-[11px] text-red-600" role="alert"></p>
          </div>

          <div>
            <label for="registrationWhatsapp" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Celular / WhatsApp *</label>
            <input id="registrationWhatsapp" name="whatsapp" type="tel" required maxlength="30" autocomplete="tel"
              class="w-full p-3 border border-slate-300 rounded-lg text-sm outline-none focus:border-[#17344D]"
              placeholder="(11) 99999-9999">
            <p data-error-for="whatsapp" class="hidden mt-1 text-[11px] text-red-600" role="alert"></p>
          </div>

          <div>
            <label for="registrationEmail" class="block text-xs font-bold text-[#17344D] uppercase mb-1">E-mail</label>
            <input id="registrationEmail" name="email" type="email" maxlength="255" autocomplete="email"
              class="w-full p-3 border border-slate-300 rounded-lg text-sm outline-none focus:border-[#17344D]"
              placeholder="voce@exemplo.com">
            <p data-error-for="email" class="hidden mt-1 text-[11px] text-red-600" role="alert"></p>
          </div>

          <div>
            <label for="registrationType" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Atuação *</label>
            <select id="registrationType" name="tipo" required
              class="w-full p-3 border border-slate-300 rounded-lg text-sm outline-none focus:border-[#17344D]">
              <option value="">Selecione</option>
              <option value="advogado">Advogado(a)</option>
              <option value="estudante">Estudante de Direito</option>
              <option value="outros">Outros</option>
            </select>
            <p data-error-for="tipo" class="hidden mt-1 text-[11px] text-red-600" role="alert"></p>
          </div>

          <p id="registrationError" class="hidden rounded-lg bg-red-50 border border-red-200 p-3 text-xs text-red-800" role="alert"></p>

          <button id="registrationSubmit" type="submit"
            class="w-full bg-[#C6282D] hover:bg-red-700 disabled:opacity-50 text-white font-bold py-3.5 px-6 rounded-xl text-xs uppercase shadow-lg transition-all">
            <span data-submit-label><i class="fa-solid fa-check-circle mr-1"></i> Confirmar inscrição</span>
          </button>
        </form>
      </section>
    </div>
  </main>

  <div id="registrationSuccessModal" class="fixed inset-0 z-[3000] hidden items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4"
    role="dialog" aria-modal="true" aria-labelledby="registrationSuccessTitle">
    <div class="max-w-md w-full rounded-2xl bg-white p-7 text-center shadow-2xl space-y-4">
      <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 text-2xl">
        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      </div>
      <h2 id="registrationSuccessTitle" class="font-title text-xl font-bold text-[#17344D]">Inscrição efetuada!</h2>
      <p class="text-sm text-slate-600">Sua inscrição para <strong>{{ $event->titulo }}</strong> foi realizada com sucesso.</p>
      <button id="closeRegistrationSuccess" type="button" class="btn-accent-mar px-6 py-3 text-xs font-bold">
        Fechar
      </button>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventRegistrationForm');
    const submitButton = document.getElementById('registrationSubmit');
    const generalError = document.getElementById('registrationError');
    const successModal = document.getElementById('registrationSuccessModal');
    const closeSuccessButton = document.getElementById('closeRegistrationSuccess');

    if (!form || !submitButton || !generalError || !successModal || !closeSuccessButton) {
      return;
    }

    const clearErrors = () => {
      generalError.textContent = '';
      generalError.classList.add('hidden');
      form.querySelectorAll('[data-error-for]').forEach((error) => {
        error.textContent = '';
        error.classList.add('hidden');
      });
    };

    const closeSuccessModal = () => {
      successModal.classList.add('hidden');
      successModal.classList.remove('flex');
      form.reset();
      clearErrors();
      form.querySelector('[name="nome"]').focus();
    };

    closeSuccessButton.addEventListener('click', closeSuccessModal);

    successModal.addEventListener('click', (event) => {
      if (event.target === successModal) {
        closeSuccessModal();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && !successModal.classList.contains('hidden')) {
        closeSuccessModal();
      }
    });

    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      clearErrors();
      submitButton.disabled = true;
      submitButton.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-1"></i> Processando...';

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: new FormData(form),
        });
        const data = await response.json();

        if (!response.ok || !data.success) {
          if (data.errors) {
            let hasFieldError = false;
            Object.entries(data.errors).forEach(([field, messages]) => {
              const error = form.querySelector(`[data-error-for="${field}"]`);
              if (error) {
                error.textContent = messages[0];
                error.classList.remove('hidden');
                hasFieldError = true;
              }
            });
            if (!hasFieldError) {
              generalError.textContent = Object.values(data.errors)[0][0];
              generalError.classList.remove('hidden');
            }
          } else {
            generalError.textContent = data.message || 'Não foi possível concluir a inscrição. Tente novamente.';
            generalError.classList.remove('hidden');
          }

          return;
        }

        successModal.classList.remove('hidden');
        successModal.classList.add('flex');
        closeSuccessButton.focus();
      } catch (error) {
        generalError.textContent = 'Não foi possível conectar ao servidor. Verifique sua conexão e tente novamente.';
        generalError.classList.remove('hidden');
      } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = '<span data-submit-label><i class="fa-solid fa-check-circle mr-1"></i> Confirmar inscrição</span>';
      }
    });
  });
</script>
@endpush
