<div>
  @if($submitted)
    <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-6 text-center space-y-4 shadow-lg">
      <div class="w-14 h-14 bg-emerald-500 text-white rounded-full mx-auto flex items-center justify-center text-2xl shadow-md">
        <i class="fa-solid fa-circle-check"></i>
      </div>
      <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
        Inscrição Confirmada
      </span>
      <h3 class="font-title text-lg font-bold text-[#17344D]">
        Vaga Garantida! Código: <span class="text-[#C6282D] font-mono">{{ $codigoInscricao }}</span>
      </h3>
      <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
        Enviamos os detalhes do credenciamento e link da transmissão para o e-mail <strong>{{ $email }}</strong>.
      </p>
      <div class="pt-2">
        <button wire:click="resetForm" class="btn-secondary-mar text-xs py-2 px-4">
          <i class="fa-solid fa-plus mr-1"></i> Fazer Nova Inscrição
        </button>
      </div>
    </div>
  @else
    <form wire:submit.prevent="submit" class="space-y-4">
      <div>
        <label for="nome" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nome Completo *</label>
        <input type="text" id="nome" wire:model.blur="nome" placeholder="Seu nome completo" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('nome') border-red-500 @else border-slate-300 @enderror">
        @error('nome') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
      </div>

      <div>
        <label for="email" class="block text-xs font-bold text-[#17344D] uppercase mb-1">E-mail Principal *</label>
        <input type="email" id="email" wire:model.blur="email" placeholder="seuemail@dominio.com" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('email') border-red-500 @else border-slate-300 @enderror">
        @error('email') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="oab_uf" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nº OAB / UF ou CPF *</label>
          <input type="text" id="oab_uf" wire:model.blur="oab_uf" placeholder="Ex: 123456/SP ou CPF" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('oab_uf') border-red-500 @else border-slate-300 @enderror">
          @error('oab_uf') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="whatsapp" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Celular / WhatsApp *</label>
          <input type="text" id="whatsapp" wire:model.blur="whatsapp" placeholder="(11) 99999-9999" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('whatsapp') border-red-500 @else border-slate-300 @enderror">
          @error('whatsapp') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
        </div>
      </div>

      <button type="submit" wire:loading.attr="disabled" class="w-full bg-[#C6282D] hover:bg-red-700 disabled:opacity-50 text-white font-bold py-3.5 px-6 rounded-xl text-xs uppercase shadow-lg transition-all flex items-center justify-center gap-2">
        <span wire:loading.remove><i class="fa-solid fa-ticket mr-1"></i> Confirmar Inscrição Gratuita</span>
        <span wire:loading><i class="fa-solid fa-circle-notch fa-spin mr-1"></i> Processando...</span>
      </button>
    </form>
  @endif
</div>
