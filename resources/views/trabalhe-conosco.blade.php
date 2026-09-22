@extends('layouts.app')

@section('title', 'Trabalhe Conosco — Instituto MAR')

@section('content')
  <section class="bg-gradient-to-b from-[#17344D] to-[#0F2334] text-white py-14 sm:py-20 px-4 sm:px-6 md:px-8 border-b border-slate-700 text-center sm:text-left">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-8 space-y-4">
        <span class="badge-mar text-xs uppercase font-bold tracking-widest">TRABALHE CONOSCO</span>
        <h1 class="font-title text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
          Junte-se ao time que transforma a advocacia
        </h1>
        <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
          Estamos em busca de talentos apaixonados por direito, conteúdo, estratégia, relacionamento e inovação para fortalecer a missão do Instituto MAR.
        </p>
      </div>

      <div class="lg:col-span-4 bg-white/10 p-6 rounded-2xl border border-white/15 backdrop-blur-md text-center space-y-3">
        <div class="text-xs uppercase font-bold text-slate-300 tracking-wider">Vagas abertas</div>
        <div class="text-2xl font-extrabold text-white font-title">Diversas áreas</div>
        <p class="text-[11px] text-slate-300">Atuação em comunicação, eventos, jurídico, institucional e projetos estratégicos.</p>
      </div>
    </div>
  </section>

  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto w-full flex-grow">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <div class="lg:col-span-12 space-y-12">
        <div class="border-b border-slate-200 pb-3">
          <span class="badge-navy text-[10px] font-bold uppercase">POR QUE FAZER PARTE</span>
          <h2 class="font-title text-2xl font-extrabold text-[#17344D] mt-1">Oportunidades para crescer com a MAR</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D] h-full">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Ambiente de Impacto</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Trabalhe em projetos que fortalecem a advocacia e a sociedade brasileira.</p>
            </div>
          </div>

          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D] h-full">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-lightbulb"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Inovação e aprendizagem</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Desenvolva seu potencial em um ambiente dinâmico, colaborativo e em constante evolução.</p>
            </div>
          </div>

          <div class="md-card p-5 flex items-start gap-4 border-l-4 border-l-[#17344D] h-full">
            <div class="w-10 h-10 rounded bg-[#17344D]/10 text-[#17344D] flex items-center justify-center text-lg font-bold shrink-0">
              <i class="fa-solid fa-hands-helping"></i>
            </div>
            <div>
              <h3 class="font-title font-bold text-base text-[#17344D]">Equipe multidisciplinar</h3>
              <p class="text-xs text-slate-600 leading-relaxed">Faça parte de uma rede que une conhecimento, estratégia e compromisso institucional.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-12">
        @livewire('resume-register')
      </div>
    </div>
  </div>
@endsection

