@extends('layouts.app')

@section('title', 'Ecossistema MAR do Futuro — Instituto MAR')

@section('content')
  <section id="visao" class="bg-[#17344D] text-white py-16 sm:py-20 px-4 sm:px-6 md:px-8 border-b-4 border-[#C6282D]">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-10 items-center">
      <div class="lg:col-span-8 space-y-5">
        <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-red-200">
          <i class="fa-solid fa-compass"></i> Instituto MAR / Visão de futuro
        </span>
        <h1 class="font-title text-3xl sm:text-5xl font-extrabold leading-tight text-white">
          A advocacia cresce em <span class="text-red-300">ecossistema.</span>
        </h1>
        <p class="text-slate-200 text-base sm:text-lg max-w-3xl leading-relaxed">
          Seu escritório conectado a mais conhecimento, tecnologia e soluções para seus clientes.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
          <a href="#ecossistema" class="btn-accent-mar text-sm">
            Conheça o projeto <i class="fa-solid fa-arrow-down"></i>
          </a>
          <a href="{{ route('associar') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-white/50 px-5 py-3 text-sm font-bold text-white hover:bg-white/10 transition-colors">
            Seja um associado <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
        <p class="text-xs text-slate-300 max-w-3xl">
          Esta é uma proposta de evolução do Instituto MAR. Novos benefícios, programas e unidades serão implantados por etapas.
        </p>
      </div>
      <div class="lg:col-span-4 bg-white/10 border border-white/15 rounded-2xl p-6 sm:p-8">
        <p class="text-xs uppercase tracking-widest text-red-200 font-bold mb-4">Uma rede colaborativa</p>
        <div class="flex items-center justify-center gap-3 text-center">
          <div class="flex-1 rounded-xl bg-white/10 p-4">
            <i class="fa-solid fa-scale-balanced text-2xl text-red-200"></i>
            <p class="mt-2 text-xs font-bold">Advocacia</p>
          </div>
          <i class="fa-solid fa-arrows-left-right text-slate-300"></i>
          <div class="flex-1 rounded-xl bg-white/10 p-4">
            <i class="fa-solid fa-handshake text-2xl text-red-200"></i>
            <p class="mt-2 text-xs font-bold">Especialistas</p>
          </div>
        </div>
        <div class="mt-3 rounded-xl border border-red-200/30 bg-[#C6282D]/20 p-4 text-center">
          <i class="fa-solid fa-user-tie text-red-200"></i>
          <p class="mt-1 text-sm font-bold">O cliente no centro</p>
          <p class="mt-1 text-xs text-slate-200">Autonomia, clareza e soluções adequadas a cada necessidade.</p>
        </div>
      </div>
    </div>
  </section>

  <nav aria-label="Nesta página" class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-3 flex gap-5 overflow-x-auto text-xs font-bold text-slate-600 whitespace-nowrap">
      <a href="#visao" class="hover:text-[#C6282D]">A visão</a>
      <a href="#ecossistema" class="hover:text-[#C6282D]">Ecossistema</a>
      <a href="#frentes" class="hover:text-[#C6282D]">Frentes de atuação</a>
      <a href="#jornada" class="hover:text-[#C6282D]">Na prática</a>
      <a href="#duvidas" class="hover:text-[#C6282D]">Dúvidas</a>
    </div>
  </nav>

  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-16 sm:space-y-20 w-full">
    <section class="grid lg:grid-cols-12 gap-8 lg:gap-14 items-start">
      <div class="lg:col-span-4">
        <span class="badge-mar text-[10px]">01 / A VISÃO</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-4">
          Seu escritório independente. Uma rede ao seu lado.
        </h2>
      </div>
      <div class="lg:col-span-8 space-y-4 text-sm sm:text-base leading-relaxed text-slate-600">
        <p>
          A proposta do MAR do Futuro é reunir, em uma só comunidade, apoio para a rotina do advogado, desenvolvimento profissional e parceiros que ampliam as soluções oferecidas aos clientes.
        </p>
        <p>
          O Instituto MAR tem como base a valorização da advocacia, a representatividade e a formação continuada. O projeto amplia essa atuação com benefícios que o associado poderá usar no dia a dia do escritório.
        </p>
        <p>
          A ideia é oferecer orientação de posicionamento, capacitação, conexões profissionais e ferramentas de apoio, mantendo a independência do escritório e a responsabilidade técnica de cada profissional.
        </p>
      </div>
    </section>

    <section id="ecossistema" class="scroll-mt-28">
      <div class="max-w-3xl mb-8">
        <span class="badge-navy text-[10px]">02 / O ECOSSISTEMA</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-4">Você amplia o atendimento. A rede apoia a entrega.</h2>
        <p class="text-sm text-slate-600 mt-3 leading-relaxed">
          Quando o cliente precisa de uma solução além do atendimento jurídico, o escritório pode apresentar a rede credenciada. O cliente escolhe com quem contratar; os responsáveis por cada serviço permanecem identificados.
        </p>
      </div>
      <div class="grid md:grid-cols-3 gap-5">
        <article class="md-card p-6">
          <span class="badge-mar text-[10px]">01 / Conexão</span>
          <h3 class="font-title font-bold text-lg text-[#17344D] mt-4">Advogado</h3>
          <p class="text-sm text-slate-600 mt-2 leading-relaxed">Identifica necessidades, mantém o foco jurídico e pode conectar seu cliente a soluções complementares adequadas.</p>
        </article>
        <article class="md-card-accent p-6">
          <span class="badge-navy text-[10px]">02 / Articulação</span>
          <h3 class="font-title font-bold text-lg text-[#17344D] mt-4">Instituto MAR</h3>
          <p class="text-sm text-slate-600 mt-2 leading-relaxed">Seleciona parceiros e propõe acompanhar etapas, prazos e qualidade por meio de uma rede e ferramentas de apoio.</p>
        </article>
        <article class="md-card p-6">
          <span class="badge-mar text-[10px]">03 / Especialidade</span>
          <h3 class="font-title font-bold text-lg text-[#17344D] mt-4">Credenciado</h3>
          <p class="text-sm text-slate-600 mt-2 leading-relaxed">Executa o serviço de sua especialidade, com escopo, preço e responsabilidades definidos diretamente para cada contratação.</p>
        </article>
      </div>
      <p class="mt-5 rounded-xl border border-slate-200 bg-white p-4 text-sm text-slate-600">
        <i class="fa-solid fa-circle-info text-[#C6282D] mr-2"></i>
        <strong class="text-[#17344D]">No centro, o cliente:</strong> conhece as opções, decide se deseja contratar e sabe quem responde por cada entrega.
      </p>
    </section>

    <section id="frentes" class="scroll-mt-28">
      <div class="mb-8">
        <span class="badge-mar text-[10px]">03 / SEIS FRENTES</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-4">Uma comunidade. Várias formas de avançar.</h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">01</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Negócios</h3>
          <p class="text-sm text-slate-600 mt-2">Parceiros para atender demandas dos clientes e ampliar as soluções apresentadas pelo escritório.</p>
        </article>
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">02</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Inteligência</h3>
          <p class="text-sm text-slate-600 mt-2">Apoio de inteligência artificial para organizar informações e preparar tarefas, com revisão do advogado.</p>
        </article>
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">03</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Conecta</h3>
          <p class="text-sm text-slate-600 mt-2">Networking para trocar experiências, conhecer especialistas e construir parcerias profissionais.</p>
        </article>
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">04</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Academia</h3>
          <p class="text-sm text-slate-600 mt-2">Treinamentos para desenvolver habilidades aplicáveis ao atendimento e à gestão do escritório.</p>
        </article>
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">05</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Voz</h3>
          <p class="text-sm text-slate-600 mt-2">Conversas com especialistas e lideranças para acompanhar mudanças e ampliar a visão profissional.</p>
        </article>
        <article class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
          <span class="text-xs font-bold text-[#C6282D]">06</span>
          <h3 class="font-title font-bold text-[#17344D] mt-3">MAR Impacto</h3>
          <p class="text-sm text-slate-600 mt-2">Mentorias, apoio à carreira e ações sociais para contribuir com profissionais e comunidade.</p>
        </article>
      </div>
      <p class="text-xs text-slate-500 mt-4">Frentes e programas propostos para desenvolvimento e implantação por etapas.</p>
    </section>

    <section id="jornada" class="scroll-mt-28">
      <div class="max-w-3xl mb-8">
        <span class="badge-navy text-[10px]">04 / NA PRÁTICA</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-4">Seu cliente tem uma demanda. Você tem uma rede de apoio.</h2>
      </div>
      <ol class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <li class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
          <span class="w-8 h-8 rounded-full bg-[#17344D] text-white flex items-center justify-center text-xs font-bold">1</span>
          <h3 class="font-title font-bold text-sm text-[#17344D] mt-4">Diagnóstico</h3>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">O advogado identifica a necessidade e, com autorização, encaminha as informações necessárias.</p>
        </li>
        <li class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
          <span class="w-8 h-8 rounded-full bg-[#17344D] text-white flex items-center justify-center text-xs font-bold">2</span>
          <h3 class="font-title font-bold text-sm text-[#17344D] mt-4">Direcionamento</h3>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">A rede identifica um especialista compatível com a demanda, sem obrigar o cliente a contratar.</p>
        </li>
        <li class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
          <span class="w-8 h-8 rounded-full bg-[#17344D] text-white flex items-center justify-center text-xs font-bold">3</span>
          <h3 class="font-title font-bold text-sm text-[#17344D] mt-4">Proposta e contrato</h3>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">Escopo, valores, prazos e responsáveis são apresentados antes da contratação.</p>
        </li>
        <li class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
          <span class="w-8 h-8 rounded-full bg-[#17344D] text-white flex items-center justify-center text-xs font-bold">4</span>
          <h3 class="font-title font-bold text-sm text-[#17344D] mt-4">Execução</h3>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">O profissional contratado executa o serviço; a proposta prevê acompanhamento das entregas.</p>
        </li>
        <li class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm sm:col-span-2 lg:col-span-1">
          <span class="w-8 h-8 rounded-full bg-[#C6282D] text-white flex items-center justify-center text-xs font-bold">5</span>
          <h3 class="font-title font-bold text-sm text-[#17344D] mt-4">Continuidade</h3>
          <p class="text-xs text-slate-600 mt-2 leading-relaxed">A rede busca acompanhar a satisfação e eventuais ajustes junto ao cliente.</p>
        </li>
      </ol>
    </section>

    <section class="grid lg:grid-cols-2 gap-6">
      <article class="bg-[#17344D] text-white rounded-2xl p-7 sm:p-9">
        <span class="text-xs font-bold uppercase tracking-widest text-red-200">Uma proposta em evolução</span>
        <h2 class="font-title text-2xl font-extrabold text-white mt-3">Apoio na rotina. Mais espaço para o trabalho estratégico.</h2>
        <p class="text-sm text-slate-200 leading-relaxed mt-4">
          Capacitação, conexões profissionais, parceiros especializados e ferramentas digitais estão entre as frentes previstas. A disponibilidade e as condições serão comunicadas conforme cada etapa for estruturada.
        </p>
      </article>
      <article class="bg-white rounded-2xl border border-slate-200 p-7 sm:p-9 shadow-sm">
        <span class="badge-mar text-[10px]">TRANSPARÊNCIA</span>
        <h2 class="font-title text-xl font-bold text-[#17344D] mt-4">O que é importante saber</h2>
        <ul class="mt-4 space-y-3 text-sm text-slate-600">
          <li class="flex gap-3"><i class="fa-solid fa-check text-[#C6282D] mt-1"></i><span>O projeto é uma proposta de implantação por etapas, não uma lista de benefícios já disponíveis.</span></li>
          <li class="flex gap-3"><i class="fa-solid fa-check text-[#C6282D] mt-1"></i><span>Valores, condições de adesão e divisão de receitas dependem da definição de cada serviço e de sua formalização.</span></li>
          <li class="flex gap-3"><i class="fa-solid fa-check text-[#C6282D] mt-1"></i><span>A contratação de soluções complementares é uma decisão do cliente e deve ter escopo e responsáveis claros.</span></li>
        </ul>
      </article>
    </section>

    <section id="duvidas" class="scroll-mt-28 max-w-4xl mx-auto">
      <div class="text-center mb-8">
        <span class="badge-mar text-[10px]">05 / DÚVIDAS</span>
        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-4">O que você precisa saber para entender a proposta.</h2>
      </div>
      <div class="space-y-3">
        <details class="bg-white rounded-xl border border-slate-200 p-5 group">
          <summary class="font-title font-bold text-sm text-[#17344D] cursor-pointer">O MAR do Futuro já está funcionando?</summary>
          <p class="text-sm text-slate-600 mt-3 leading-relaxed">Esta página apresenta uma proposta de evolução. Programas, benefícios e unidades serão estruturados e divulgados por etapas; consulte os canais oficiais para saber o que está disponível.</p>
        </details>
        <details class="bg-white rounded-xl border border-slate-200 p-5 group">
          <summary class="font-title font-bold text-sm text-[#17344D] cursor-pointer">A rede substitui o trabalho do advogado?</summary>
          <p class="text-sm text-slate-600 mt-3 leading-relaxed">Não. A proposta busca apoiar o escritório e conectar clientes a especialistas em outras áreas. Cada profissional permanece responsável pelo serviço que presta, e a atuação jurídica continua sob responsabilidade do advogado contratado.</p>
        </details>
        <details class="bg-white rounded-xl border border-slate-200 p-5 group">
          <summary class="font-title font-bold text-sm text-[#17344D] cursor-pointer">A contratação de parceiros é obrigatória?</summary>
          <p class="text-sm text-slate-600 mt-3 leading-relaxed">Não. A decisão de contratar uma solução é do cliente, após conhecer o escopo, o preço e as condições apresentados pelo responsável pelo serviço.</p>
        </details>
        <details class="bg-white rounded-xl border border-slate-200 p-5 group">
          <summary class="font-title font-bold text-sm text-[#17344D] cursor-pointer">Quais serão os valores e benefícios da associação?</summary>
          <p class="text-sm text-slate-600 mt-3 leading-relaxed">As condições serão informadas oficialmente quando forem definidas para cada etapa. Nenhum valor ou projeção desta proposta deve ser entendido como garantia de receita ou resultado.</p>
        </details>
      </div>
    </section>

    <section class="bg-slate-100 rounded-2xl border border-slate-200 p-7 sm:p-10 text-center">
      <p class="text-xs font-bold uppercase tracking-widest text-[#C6282D]">MAR do Futuro</p>
      <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-[#17344D] mt-3">Seu escritório com mais apoio. Seus clientes com mais soluções.</h2>
      <p class="text-sm text-slate-600 max-w-2xl mx-auto mt-3">Uma proposta para conectar desenvolvimento profissional, especialistas e novas possibilidades para a advocacia.</p>
      <a href="{{ route('associar') }}" class="btn-primary-mar text-sm mt-6">Conheça a associação <i class="fa-solid fa-arrow-right"></i></a>
    </section>
  </div>
@endsection
