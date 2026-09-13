@extends('layouts.app')

@section('title', 'Fale Conosco — Contato Institucional — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">ATENDIMENTO INSTITUCIONAL</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Fale Conosco</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Estamos à disposição para atender a advocacia brasileira, imprensa, parceiros e novos associados.
      </p>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow space-y-16">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- FORMULÁRIO DE CONTATO -->
      <div class="lg:col-span-7 bg-white p-6 sm:p-10 rounded-2xl border border-slate-200 shadow-xl space-y-6">
        <div class="border-b border-slate-100 pb-4">
          <span class="badge-navy text-[10px] font-bold uppercase">MENSAGEM DIRETA</span>
          <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D] mt-1">Envie sua mensagem</h2>
          <p class="text-xs text-slate-500">Preencha o formulário e nossa equipe retornará em até 24 horas úteis.</p>
        </div>

        @if(session('success'))
          <div class="p-4 bg-emerald-50 border border-emerald-300 rounded-xl text-emerald-800 text-xs flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg shrink-0"></i>
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if($errors->any())
          <div class="p-4 bg-red-50 border border-red-300 rounded-xl text-red-800 text-xs space-y-1">
            <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-triangle-exclamation text-red-600"></i> Verifique os dados informados:</div>
            <ul class="list-disc list-inside text-[11px] text-red-700">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div id="contact-feedback" class="hidden p-4 rounded-xl text-xs flex items-center gap-3"></div>

        <form id="contactForm" method="POST" action="{{ route('contato.store') }}" class="space-y-4">
          @csrf
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label for="contact_nome" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Seu Nome *</label>
              <input type="text" id="contact_nome" name="nome" value="{{ old('nome') }}" required placeholder="Digite seu nome" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>

            <div>
              <label for="contact_email" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Seu E-mail *</label>
              <input type="email" id="contact_email" name="email" value="{{ old('email') }}" required placeholder="seuemail@adv.br" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label for="contact_phone" class="block text-xs font-bold text-[#17344D] uppercase mb-1">WhatsApp / Telefone *</label>
              <input type="text" id="contact_phone" name="phone" value="{{ old('phone') }}" required placeholder="(11) 99999-9999" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>

            <div>
              <label for="contact_subject" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Assunto / Departamento *</label>
              <select id="contact_subject" name="subject" required class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                <option value="GERAL" {{ old('subject') == 'GERAL' ? 'selected' : '' }}>Informações Gerais</option>
                <option value="ASSOCIADO" {{ old('subject') == 'ASSOCIADO' ? 'selected' : '' }}>Dúvidas sobre Associação</option>
                <option value="EVENTOS" {{ old('subject') == 'EVENTOS' ? 'selected' : '' }}>Eventos e Cursos</option>
                <option value="IMPRENSA" {{ old('subject') == 'IMPRENSA' ? 'selected' : '' }}>Assessoria de Imprensa</option>
                <option value="OUVIDORIA" {{ old('subject') == 'OUVIDORIA' ? 'selected' : '' }}>Ouvidoria Institucional</option>
              </select>
            </div>
          </div>

          <div>
            <label for="contact_message" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Mensagem *</label>
            <textarea id="contact_message" name="message" rows="5" required placeholder="Escreva sua mensagem com detalhes..." class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">{{ old('message') }}</textarea>
          </div>

          <button type="submit" id="btnContactSubmit" class="btn-primary-mar w-full text-xs py-4 shadow-lg flex items-center justify-center gap-2">
            <i class="fa-solid fa-paper-plane mr-1.5"></i> Enviar Mensagem Institucional
          </button>
        </form>
      </div>

      <!-- INFORMAÇÕES DE CONTATO E SEDES -->
      <div class="lg:col-span-5 space-y-6">
        
        <!-- CARDS DE CONTATO POR SETOR -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
          <h3 class="font-title font-bold text-base text-[#17344D] border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-building-columns text-[#C6282D]"></i> Sedes Nacionais
          </h3>

          <div class="space-y-4 text-xs text-slate-600">
            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#17344D]">
              <div class="font-bold text-[#17344D] flex items-center gap-1.5">
                <i class="fa-solid fa-location-dot text-[#C6282D]"></i> Sede Brasília (DF)
              </div>
              <p>{{ $siteSettings->endereco_sede_df ?? 'Setor de Autarquias Sul, Quadra 05, Lote 02 — Brasília / DF' }}</p>
              <p class="text-[11px] text-slate-400">CEP: 70070-900 • <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings->telefone_plantao ?? '6132000000') }}" class="hover:text-[#17344D] transition-colors">Tel: {{ $siteSettings->telefone_plantao ?? '(61) 3200-0000' }}</a></p>
            </div>

            <div class="p-3 bg-slate-50 rounded-lg space-y-1 border-l-4 border-l-[#17344D]">
              <div class="font-bold text-[#17344D] flex items-center gap-1.5">
                <i class="fa-solid fa-location-dot text-[#C6282D]"></i> Sede São Paulo (SP)
              </div>
              <p>{{ $siteSettings->endereco_sede_sp ?? 'Av. Paulista, 1842, 14º andar — Bela Vista — São Paulo / SP' }}</p>
              <p class="text-[11px] text-slate-400">CEP: 01310-200 • <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings->telefone_plantao ?? '1131000000') }}" class="hover:text-[#17344D] transition-colors">Tel: {{ $siteSettings->telefone_plantao ?? '(11) 3100-0000' }}</a></p>
            </div>
          </div>
        </div>

        <!-- CONTATOS DIRETOS -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3 text-xs">
          <h3 class="font-title font-bold text-base text-[#17344D] border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="fa-solid fa-envelope-open-text text-[#C6282D]"></i> E-mails Departamentais
          </h3>

          <div class="space-y-2 text-slate-600">
            <p><strong>Geral:</strong> <a href="mailto:{{ $siteSettings->email_contato ?? 'contato@institutomar.org.br' }}" class="text-[#17344D] hover:underline">{{ $siteSettings->email_contato ?? 'contato@institutomar.org.br' }}</a></p>
            <p><strong>Prerrogativas 24h:</strong> <a href="mailto:prerrogativas@institutomar.org.br" class="text-[#C6282D] font-bold hover:underline">prerrogativas@institutomar.org.br</a></p>
            <p><strong>Imprensa:</strong> <a href="mailto:imprensa@institutomar.org.br" class="text-[#17344D] hover:underline">imprensa@institutomar.org.br</a></p>
            <p><strong>Ouvidoria:</strong> <a href="mailto:ouvidoria@institutomar.org.br" class="text-[#17344D] hover:underline">ouvidoria@institutomar.org.br</a></p>
          </div>
        </div>

      </div>

    </div>

    <!-- SEÇÃO FAQ (PERGUNTAS FREQUENTES) -->
    <section class="space-y-6 pt-6">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <span class="badge-mar text-[10px] font-bold uppercase">TIRA-DÚVIDAS</span>
        <h2 class="font-title font-extrabold text-2xl text-[#17344D]">Perguntas Frequentes (FAQ)</h2>
        <p class="text-xs text-slate-500">Respostas rápidas para as principais dúvidas de advogados e associados.</p>
      </div>

      <div class="max-w-4xl mx-auto space-y-4 text-xs sm:text-sm">
        
        <div class="md-card p-5 space-y-2">
          <h4 class="font-title font-bold text-base text-[#17344D]">Quem pode se associar ao Instituto MAR?</h4>
          <p class="text-slate-600 leading-relaxed">
            Podem se associar advogados e advogadas inscritos regularmente na OAB, bem como bacharéis e estudantes de Direito na condição de associados acadêmicos.
          </p>
        </div>

        <div class="md-card p-5 space-y-2">
          <h4 class="font-title font-bold text-base text-[#17344D]">Como funciona a assistência em defesa de prerrogativas?</h4>
          <p class="text-slate-600 leading-relaxed">
            Advogados que enfrentarem violação de prerrogativas durante o exercício profissional podem acionar nosso Canal Emergencial de Prerrogativas 24h para envio de assistência técnica parecerística e acompanhamento institucional.
          </p>
        </div>

        <div class="md-card p-5 space-y-2">
          <h4 class="font-title font-bold text-base text-[#17344D]">Os eventos e simpósios são gratuitos?</h4>
          <p class="text-slate-600 leading-relaxed">
            A maioria dos simpósios e painéis de formação continuada promovidos pelo Instituto MAR é gratuita para associados cadastrados, com emissão de certificado oficial.
          </p>
        </div>

      </div>
    </section>

  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const feedback = document.getElementById('contact-feedback');
    const btn = document.getElementById('btnContactSubmit');

    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-1.5"></i> Enviando mensagem...';
        }

        try {
          const formData = new FormData(form);
          const response = await fetch(form.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json'
            },
            body: formData
          });

          const result = await response.json();

          if (response.ok && result.success) {
            feedback.className = 'p-4 bg-emerald-50 border border-emerald-300 rounded-xl text-emerald-800 text-xs flex items-center gap-3 shadow-sm';
            feedback.innerHTML = '<i class="fa-solid fa-circle-check text-emerald-600 text-lg shrink-0"></i><div>' + result.message + '</div>';
            feedback.classList.remove('hidden');
            form.reset();
            feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            let errorMsg = result.message || 'Ocorreu um erro ao enviar sua mensagem.';
            if (result.errors) {
              const errorsList = Object.values(result.errors).flat().join('<br>');
              errorMsg += '<br><span class="text-[11px]">' + errorsList + '</span>';
            }
            feedback.className = 'p-4 bg-red-50 border border-red-300 rounded-xl text-red-800 text-xs flex items-start gap-3 shadow-sm';
            feedback.innerHTML = '<i class="fa-solid fa-triangle-exclamation text-red-600 text-lg shrink-0 mt-0.5"></i><div>' + errorMsg + '</div>';
            feedback.classList.remove('hidden');
          }
        } catch (err) {
          // Fallback submitting natively if fetch network error
          form.submit();
        } finally {
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane mr-1.5"></i> Enviar Mensagem Institucional';
          }
        }
      });
    }
  });
</script>
@endpush
