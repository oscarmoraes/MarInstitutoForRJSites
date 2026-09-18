@extends('layouts.app')

@section('title', 'Seja um Associado — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-gradient-to-b from-[#17344D] to-[#0F2334] text-white py-14 sm:py-20 px-4 sm:px-6 md:px-8 border-b border-slate-700 text-center sm:text-left">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-8 space-y-4">
        <span class="badge-mar text-xs uppercase font-bold tracking-widest">JUNTE-SE À REVOLUÇÃO ÉTICA</span>
        <h1 class="font-title text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
          Faça parte do Movimento da Advocacia Renovada
        </h1>
        <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
          Associar-se ao Instituto MAR é integrar uma rede nacional de advogados, professores e lideranças focados no fortalecimento das prerrogativas e na formação continuada.
        </p>
      </div>

      <div class="lg:col-span-4 bg-white/10 p-6 rounded-2xl border border-white/15 backdrop-blur-md text-center space-y-3">
        <div class="text-xs uppercase font-bold text-slate-300 tracking-wider">Apoio Institucional</div>
        <div class="text-2xl font-extrabold text-white font-title">+ 3.500 Advogados</div>
        <p class="text-[11px] text-slate-300">Conectados em 27 unidades federativas do Brasil.</p>
      </div>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL E FORMULÁRIO -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- COLUNA BENEFÍCIOS -->
      <div class="lg:col-span-12 space-y-12">
        <div class="border-b border-slate-200 pb-3">
          <span class="badge-navy text-[10px] font-bold uppercase">POR QUE SE ASSOCIAR</span>
          <h2 class="font-title text-2xl font-extrabold text-[#17344D] mt-1">Benefícios do Associado MAR</h2>
        </div>

        <div class="space-y-4">
          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D]">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Suporte de Prerrogativas</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Acesso à rede nacional de apoio contra violações do exercício profissional.</p>
            </div>
          </div>

          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D]">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Cursos & Mentoria Gratuita</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Acesso prioritário a eventos, congressos e programa de mentoria entre sêniores e novos advogados.</p>
            </div>
          </div>

          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D]">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-network-wired"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Networking Nacional</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Conexão direta com escritórios e correspondentes em todos os estados brasileiros.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- COLUNA FORMULÁRIO -->
      <div class="lg:col-span-12">
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xl space-y-6">
          <div class="border-b border-slate-100 pb-4">
            <span class="badge-mar text-[10px] font-bold uppercase">CADASTRO DE SOLICITAÇÃO</span>
            <h2 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D] mt-1">Formulário de Associação</h2>
            <p class="text-xs text-slate-500">Preencha os dados abaixo para submeter sua candidatura ao Instituto MAR.</p>
          </div>

          @if(session('success'))
            <div class="p-6 bg-emerald-50 border-2 border-emerald-500 rounded-2xl text-center space-y-3 shadow-md">
              <div class="w-12 h-12 bg-emerald-500 text-white rounded-full mx-auto flex items-center justify-center text-xl">
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <h3 class="font-title font-bold text-lg text-emerald-900">Solicitação Enviada com Sucesso!</h3>
              <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
                {{ session('success') }}
              </p>
              @if(session('matricula'))
                <div class="inline-block bg-white px-4 py-2 rounded-xl border border-emerald-200 text-xs font-bold text-[#17344D] shadow-sm">
                  Matrícula Provisória: <span class="text-[#C6282D] font-mono text-sm ml-1">{{ session('matricula') }}</span>
                </div>
              @endif
              <p class="text-[11px] text-slate-400">Nossa comissão entrará em contato para validação dos dados e emissão da credencial.</p>
            </div>
          @endif

          @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-300 rounded-xl text-red-800 text-xs space-y-1">
              <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-triangle-exclamation text-red-600"></i> Erros no preenchimento:</div>
              <ul class="list-disc list-inside text-[11px] text-red-700">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div id="associacao-feedback" class="hidden p-6 rounded-2xl text-center space-y-3 shadow-md"></div>

          <form id="associado-form" method="POST" action="{{ route('associar.store') }}" class="space-y-4">
            @csrf
            <div>
              <label for="full_name" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nome Completo *</label>
              <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required placeholder="Digite seu nome completo" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="cpf" class="block text-xs font-bold text-[#17344D] uppercase mb-1">CPF *</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required placeholder="123.456.789-00" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="birth_date" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Data de Nascimento *</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
            </div>

            <div>
              <label for="email" class="block text-xs font-bold text-[#17344D] uppercase mb-1">E-mail Profissional *</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="seuemail@adv.br" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 ">
              <div>
                <label for="phone_primary" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Telefone Principal (DDD) *</label>
                <input type="text" id="phone_primary" name="phone_primary" value="{{ old('phone_primary') }}" required placeholder="(11) 99999-9999" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="phone_secondary" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Telefone Secundário (DDD)</label>
                <input type="text" id="phone_secondary" name="phone_secondary" value="{{ old('phone_secondary') }}" placeholder="(11) 99999-9999" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="phone_office" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Telefone do Escritório (DDD)</label>
                <input type="text" id="phone_office" name="phone_office" value="{{ old('phone_office') }}" placeholder="(11) 99999-9999" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
            </div>

            <div class="border-b border-slate-100 pb-4"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="oab" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nº OAB *</label>
                <input type="text" id="oab" name="oab" value="{{ old('oab') }}" required placeholder="123456" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <abel form="oab_state_id" class="block text-xs font-bold text-[#17344D] uppercase mb-1">UF OAB *</label>
                <select id="oab_state_id" name="oab_state_id" required class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                  <option value="">Selecione a UF</option>
                  @foreach($oabStates as $state)
                    <option value="{{ $state->id }}" {{ old('oab_state_id') == $state->id ? 'selected' : '' }}>{{ $state->letter }}</option>
                  @endforeach
                </select>
              </div>
              <!-- <div>
                <label for="categoria" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Categoria *</label>
                <select id="categoria" name="categoria" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                  <option value="Advogado Efetivo" {{ old('categoria') == 'Advogado Efetivo' ? 'selected' : '' }}>Advogado Efetivo</option>
                  <option value="Estudante / Acadêmico" {{ old('categoria') == 'Estudante / Acadêmico' ? 'selected' : '' }}>Estudante / Acadêmico</option>
                  <option value="Membro Honorário" {{ old('categoria') == 'Membro Honorário' ? 'selected' : '' }}>Membro Honorário</option>
                </select>
              </div> -->
            </div>

            <div class="border-b border-slate-100 pb-4"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="cep" class="block text-xs font-bold text-[#17344D] uppercase mb-1">CEP *</label>
                <input type="text" id="cep" name="cep" value="{{ old('cep') }}" required placeholder="12345-678" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="state_id" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Estado *</label>
                <select id="state_id" name="state_id" required class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                  <option value="">Selecione o Estado</option>
                  @foreach($oabStates as $state)
                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->letter }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div>
              <label for="street" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Endereço (Rua / Av.) *</label>
              <input type="text" id="street" name="street" value="{{ old('street') }}" required placeholder="Digite o endereço" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="number" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Número *</label>
                <input type="text" id="number" name="number" value="{{ old('number') }}" required placeholder="123" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="complement" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Complemento</label>
                <input type="text" id="complement" name="complement" value="{{ old('complement') }}" placeholder="Apto, Bloco, Sala, etc." class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="neighborhood" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Bairro *</label>
                <input type="text" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}" required placeholder="Digite o bairro" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
              </div>
              <div>
                <label for="city_id" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Cidade *</label>
                <select id="city_id" name="city_id" required class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                  <option value="">Selecione a Cidade</option>
                  @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            

            <button type="submit" id="btnAssociarSubmit" class="btn-accent-mar w-full text-xs py-4 shadow-lg flex items-center justify-center gap-2">
              <i class="fa-solid fa-paper-plane mr-1.5"></i> Enviar Solicitação de Associação
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('associado-form');
    const feedback = document.getElementById('associacao-feedback');
    const btn = document.getElementById('btnAssociarSubmit');

    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (btn) {
          btn.disabled = true;
          btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-1.5"></i> Processando filiação...';
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
            feedback.className = 'p-6 bg-emerald-50 border-2 border-emerald-500 rounded-2xl text-center space-y-3 shadow-md';
            feedback.innerHTML = `
              <div class="w-12 h-12 bg-emerald-500 text-white rounded-full mx-auto flex items-center justify-center text-xl">
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <h3 class="font-title font-bold text-lg text-emerald-900">Solicitação Enviada com Sucesso!</h3>
              <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">${result.message}</p>
              ${result.matricula ? `<div class="inline-block bg-white px-4 py-2 rounded-xl border border-emerald-200 text-xs font-bold text-[#17344D] shadow-sm">Matrícula Provisória: <span class="text-[#C6282D] font-mono text-sm ml-1">${result.matricula}</span></div>` : ''}
              <p class="text-[11px] text-slate-400">Nossa comissão entrará em contato para validação dos dados e emissão da credencial.</p>
            `;
            feedback.classList.remove('hidden');
            form.reset();
            feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
          } else {
            let errorMsg = result.message || 'Ocorreu um erro ao submeter a solicitação.';
            if (result.errors) {
              const errorsList = Object.values(result.errors).flat().join('<br>');
              errorMsg += '<br><span class="text-[11px]">' + errorsList + '</span>';
            }
            feedback.className = 'p-4 bg-red-50 border border-red-300 rounded-xl text-red-800 text-xs text-left shadow-sm';
            feedback.innerHTML = '<div class="font-bold mb-1"><i class="fa-solid fa-triangle-exclamation text-red-600 mr-1.5"></i> Falha no envio:</div><div>' + errorMsg + '</div>';
            feedback.classList.remove('hidden');
          }
        } catch (err) {
          form.submit();
        } finally {
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane mr-1.5"></i> Enviar Solicitação de Associação';
          }
        }
      });
    }
  });
</script>
@endpush
