<div class="space-y-6">
  <form wire:submit.prevent="validateCertificate" class="flex flex-col sm:flex-row gap-3">
    <div class="flex-grow">
      <input type="text" wire:model.blur="codigo" placeholder="Digite o Código de Autenticação (ex: MAR-2026-8849)" class="w-full p-4 border rounded-xl text-xs uppercase font-mono tracking-wider outline-none focus:border-[#17344D] @error('codigo') border-red-500 @else border-slate-300 @enderror">
      @error('codigo') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
    </div>
    <button type="submit" wire:loading.attr="disabled" class="bg-[#17344D] hover:bg-slate-800 disabled:opacity-50 text-white font-bold px-8 py-4 rounded-xl text-xs uppercase shadow-md transition-all shrink-0 flex items-center justify-center gap-2">
      <span wire:loading.remove><i class="fa-solid fa-shield-check mr-1"></i> Validar Autenticidade</span>
      <span wire:loading><i class="fa-solid fa-circle-notch fa-spin mr-1"></i> Consultando...</span>
    </button>
  </form>

  @if($searched)
    @if($certificate)
      <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-6 sm:p-8 space-y-6 shadow-xl">
        <div class="flex items-center justify-between border-b border-emerald-200 pb-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-emerald-500 text-white rounded-full flex items-center justify-center text-2xl shadow-md">
              <i class="fa-solid fa-[#ffffff] fa-certificate"></i>
            </div>
            <div>
              <span class="bg-emerald-200 text-emerald-900 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                Documento Autêntico e Válido
              </span>
              <h3 class="font-title text-lg font-bold text-[#17344D] mt-0.5">Certificado de Participação Confirmado</h3>
            </div>
          </div>
          <span class="text-xs font-mono text-emerald-800 font-bold hidden sm:inline">STATUS: VÁLIDO</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
          <div class="bg-white p-4 rounded-xl border border-emerald-100 space-y-1">
            <span class="text-[10px] font-bold text-slate-400 uppercase">Titular / Participante:</span>
            <div class="font-bold text-[#17344D] text-sm">{{ $certificate->participante_nome }}</div>
            <div class="text-slate-500 text-[11px]">OAB/UF: {{ $certificate->oab_uf }}</div>
          </div>

          <div class="bg-white p-4 rounded-xl border border-emerald-100 space-y-1">
            <span class="text-[10px] font-bold text-slate-400 uppercase">Evento / Curso:</span>
            <div class="font-bold text-[#17344D] text-sm">{{ $certificate->evento_titulo }}</div>
            <div class="text-slate-500 text-[11px]">Carga Horária: {{ $certificate->carga_horaria }}h</div>
          </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-emerald-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs font-mono">
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase block font-sans">Hash Digital da Assinatura:</span>
            <span class="text-slate-600 break-all text-[11px]">{{ $certificate->hash_digital }}</span>
          </div>
          <div class="text-right shrink-0">
            <span class="text-[10px] font-bold text-slate-400 uppercase block font-sans">Data Emissão:</span>
            <span class="text-[#17344D] font-bold">{{ $certificate->data_emissao ? $certificate->data_emissao->format('d/m/Y') : 'N/A' }}</span>
          </div>
        </div>

        <div class="flex justify-end pt-2">
          <button wire:click="resetSearch" class="btn-secondary-mar text-xs py-2 px-4">
            <i class="fa-solid fa-rotate-left mr-1"></i> Nova Consulta
          </button>
        </div>
      </div>
    @else
      <div class="bg-red-50 border-2 border-red-400 rounded-2xl p-6 text-center space-y-4 shadow-lg">
        <div class="w-14 h-14 bg-red-500 text-white rounded-full mx-auto flex items-center justify-center text-2xl shadow-md">
          <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="font-title text-lg font-bold text-[#17344D]">Certificado Não Encontrado</h3>
        <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
          Nenhum certificado foi localizado para o código <strong>"{{ $codigo }}"</strong>. Verifique se digitou corretamente o código impresso ou consulte a Secretaria do Instituto MAR.
        </p>
        <button wire:click="resetSearch" class="btn-secondary-mar text-xs py-2 px-4">
          <i class="fa-solid fa-arrow-left mr-1"></i> Tentar Novamente
        </button>
      </div>
    @endif
  @endif
</div>
