@extends('layouts.app')

@section('title', 'Notas e Atos Oficiais — Instituto MAR')

@section('content')
  <!-- HERO -->
  <section class="bg-[#17344D] text-white py-14 sm:py-16 px-4 sm:px-6 md:px-8 border-b border-slate-700">
    <div class="max-w-7xl mx-auto space-y-3 text-center sm:text-left">
      <span class="badge-mar text-xs uppercase font-bold tracking-widest">ACERVO DE TRANSPARÊNCIA</span>
      <h1 class="font-title text-2xl sm:text-4xl font-extrabold text-white">Notas e Atos Oficiais</h1>
      <p class="text-slate-300 text-xs sm:text-base max-w-3xl font-light leading-relaxed">
        Repositório público de manifestos, portarias, pareceres técnicos e pronunciamentos institucionais emitidos pelo Instituto MAR.
      </p>
    </div>
  </section>

  <!-- PÁGINA PRINCIPAL -->
  <div class="py-12 sm:py-16 px-4 sm:px-6 md:px-8 max-w-7xl mx-auto space-y-8 w-full flex-grow">

    <!-- FILTROS DE PESQUISA -->
    <div class="bg-white p-5 sm:p-6 rounded-xl border border-slate-200 shadow-sm">
      <form method="GET" action="{{ route('notas-oficiais') }}" class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
          <div class="w-full sm:w-auto">
            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Categoria:</label>
            <select name="categoria" onchange="this.form.submit()" class="w-full sm:w-48 p-2.5 bg-slate-50 border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-[#17344D] focus:outline-none">
              <option value="todas">Todas as Categorias</option>
              @foreach($categories as $cat)
                @php
                  $label = match($cat) {
                    'NOTA_OFICIAL' => 'Nota Oficial',
                    'RESOLUCAO' => 'Resolução',
                    'PORTARIA' => 'Portaria',
                    'MANIFESTO' => 'Manifesto',
                    'ATO_INSTITUCIONAL' => 'Ato Institucional',
                    default => $cat,
                  };
                @endphp
                <option value="{{ $cat }}" {{ ($categoriaSelecionada ?? '') === $cat ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>

          @if(isset($years) && $years->count() > 0)
            <div class="w-full sm:w-auto">
              <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Ano:</label>
              <select name="ano" onchange="this.form.submit()" class="w-full sm:w-36 p-2.5 bg-slate-50 border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-[#17344D] focus:outline-none">
                <option value="todos">Todos os Anos</option>
                @foreach($years as $yr)
                  <option value="{{ $yr }}" {{ (string)($anoSelecionado ?? '') === (string)$yr ? 'selected' : '' }}>
                    {{ $yr }}
                  </option>
                @endforeach
              </select>
            </div>
          @endif
        </div>

        <div class="w-full md:w-80 flex items-end gap-2">
          <div class="flex-grow">
            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Buscar Palavra-chave:</label>
            <div class="relative">
              <input type="text" name="busca" value="{{ $busca ?? '' }}" placeholder="Título ou número do documento..." class="w-full p-2.5 pl-9 bg-slate-50 border border-slate-300 rounded-lg text-xs focus:ring-2 focus:ring-[#17344D] focus:outline-none">
              <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-slate-400 text-xs"></i>
            </div>
          </div>
          <button type="submit" class="btn-primary-mar text-xs py-2.5 px-4 shrink-0">
            Filtrar
          </button>
          @if(!empty($categoriaSelecionada) || !empty($anoSelecionado) || !empty($busca))
            <a href="{{ route('notas-oficiais') }}" class="p-2.5 text-slate-400 hover:text-[#C6282D] text-xs font-bold shrink-0" title="Limpar filtros">
              <i class="fa-solid fa-xmark text-sm"></i>
            </a>
          @endif
        </div>
      </form>
    </div>

    <!-- TABELA / LISTA DE ATOS -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
      <div class="p-5 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-title font-bold text-base text-[#17344D]">Documentos Institucionais Publicados</h2>
        <div class="text-xs text-slate-500">
          Exibindo {{ $documents->count() }} {{ $documents->count() === 1 ? 'registro' : 'registros' }}
        </div>
      </div>

      <div class="divide-y divide-slate-200">
        @forelse($documents as $doc)
          @php
            $isNoticeOrManifesto = in_array($doc->categoria, ['NOTA_OFICIAL', 'MANIFESTO']);
            $catLabel = match($doc->categoria) {
              'NOTA_OFICIAL' => 'Nota Oficial',
              'RESOLUCAO' => 'Resolução',
              'PORTARIA' => 'Portaria',
              'MANIFESTO' => 'Manifesto',
              'ATO_INSTITUCIONAL' => 'Ato Institucional',
              default => $doc->categoria,
            };
          @endphp
          <div class="p-5 hover:bg-slate-50/80 transition-colors flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="space-y-1.5 max-w-3xl">
              <div class="flex items-center gap-2">
                <span class="{{ $isNoticeOrManifesto ? 'badge-mar' : 'badge-navy' }} text-[10px] font-bold">
                  {{ $doc->numero }}
                </span>
                <span class="text-xs text-slate-400">
                  <i class="fa-regular fa-calendar mr-1"></i>
                  {{ $doc->data_publicacao ? $doc->data_publicacao->translatedFormat('d \d\e F, Y') : '' }}
                </span>
                <span class="text-slate-300 hidden sm:inline">•</span>
                <span class="text-[10px] font-semibold text-slate-400 uppercase hidden sm:inline">
                  {{ $catLabel }}
                </span>
              </div>
              <h3 class="font-title font-bold text-base text-[#17344D]">
                {{ $doc->titulo }}
              </h3>
              @if($doc->resumo)
                <p class="text-xs text-slate-600 leading-relaxed">
                  {{ $doc->resumo }}
                </p>
              @endif
            </div>
            <a href="{{ $doc->arquivo_url ?: '#' }}" class="btn-outline-mar text-xs py-2 px-4 shrink-0 flex items-center gap-1.5">
              <i class="fa-solid fa-file-pdf text-[#C6282D]"></i> Baixar PDF
            </a>
          </div>
        @empty
          <div class="p-12 text-center text-slate-500 space-y-2">
            <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
            <p class="font-medium text-sm">Nenhum ato oficial ou nota encontrado com os filtros selecionados.</p>
            <p class="text-xs text-slate-400">Tente ajustar os termos de pesquisa ou selecionar outra categoria.</p>
          </div>
        @endforelse
      </div>
    </div>

  </div>
@endsection
