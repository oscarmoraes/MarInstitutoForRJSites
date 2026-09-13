<div>
  @if($submitted)
    <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-6 sm:p-8 text-center space-y-4 shadow-xl">
      <div class="w-16 h-16 bg-emerald-500 text-white rounded-full mx-auto flex items-center justify-center text-3xl shadow-lg">
        <i class="fa-solid fa-shield-check"></i>
      </div>
      <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
        Transmissão Confirmada (Livewire 4)
      </span>
      <h3 class="font-title text-xl sm:text-2xl font-extrabold text-[#17344D]">
        Acionamento Registrado sob Protocolo Nº <span class="text-[#C6282D] font-mono">{{ $protocolo }}</span>
      </h3>
      <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto leading-relaxed">
        A Comissão de Prerrogativas do Instituto MAR foi notificada em tempo real. Um plantonista entrará em contato com urgência.
      </p>
      <div class="pt-2">
        <button wire:click="resetForm" class="btn-primary-mar text-xs py-3 px-6 shadow-md">
          <i class="fa-solid fa-plus mr-1"></i> Enviar Novo Chamado
        </button>
      </div>
    </div>
  @else
    <form wire:submit.prevent="submit" class="space-y-6">
      
      <!-- SEÇÃO 1: DADOS DO ADVOGADO -->
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#C6282D] border-b border-slate-100 pb-1 flex items-center gap-1.5">
          <i class="fa-solid fa-id-card"></i> 1. Identificação do Advogado Requerente
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="adv_nome" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nome Completo *</label>
            <input type="text" id="adv_nome" wire:model.blur="adv_nome" placeholder="Dr. / Dra. Nome do Advogado" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('adv_nome') border-red-500 @else border-slate-300 @enderror">
            @error('adv_nome') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label for="adv_oab" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nº OAB *</label>
              <input type="text" id="adv_oab" wire:model.blur="adv_oab" placeholder="123456" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('adv_oab') border-red-500 @else border-slate-300 @enderror">
              @error('adv_oab') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
            </div>
            <div>
              <label for="adv_uf" class="block text-xs font-bold text-[#17344D] uppercase mb-1">UF OAB *</label>
              <select id="adv_uf" wire:model="adv_uf" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] bg-white">
                <option value="SP">SP</option>
                <option value="DF">DF</option>
                <option value="RJ">RJ</option>
                <option value="MG">MG</option>
                <option value="PR">PR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="BA">BA</option>
                <option value="PE">PE</option>
                <option value="GO">GO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="adv_email" class="block text-xs font-bold text-[#17344D] uppercase mb-1">E-mail Profissional *</label>
            <input type="email" id="adv_email" wire:model.blur="adv_email" placeholder="advogado@oab.org.br" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('adv_email') border-red-500 @else border-slate-300 @enderror">
            @error('adv_email') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
          </div>

          <div>
            <label for="adv_phone" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Celular / WhatsApp 24h *</label>
            <input type="text" id="adv_phone" wire:model.blur="adv_phone" placeholder="(11) 99999-9999" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('adv_phone') border-red-500 @else border-slate-300 @enderror">
            @error('adv_phone') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>

      <!-- SEÇÃO 2: DETALHES DA VIOLAÇÃO -->
      <div class="space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#C6282D] border-b border-slate-100 pb-1 flex items-center gap-1.5">
          <i class="fa-solid fa-triangle-exclamation"></i> 2. Detalhes da Ocorrência / Atentado
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="tipo_violacao" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Tipo de Violação Principal *</label>
            <select id="tipo_violacao" wire:model="tipo_violacao" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] bg-white @error('tipo_violacao') border-red-500 @else border-slate-300 @enderror">
              <option value="">Selecione o tipo de violação...</option>
              <option value="Desrespeito a Honorários Arbitrados">Desrespeito a Honorários Arbitrados</option>
              <option value="Impedimento de Acesso aos Autos">Impedimento de Acesso aos Autos ou Inquéritos</option>
              <option value="Busca e Apreensão Ilegal em Escritório">Busca e Apreensão Ilegal em Escritório</option>
              <option value="Prisão / Retenção no Exercício da Profissão">Prisão / Retenção no Exercício da Profissão</option>
              <option value="Desrespeito à Urbanidade por Autoridade">Desrespeito à Urbanidade por Autoridade</option>
              <option value="Outra Violação de Prerrogativa">Outra Violação de Prerrogativa</option>
            </select>
            @error('tipo_violacao') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
          </div>

          <div>
            <label for="orgao_local" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Órgão / Tribunal / Delegacia *</label>
            <input type="text" id="orgao_local" wire:model.blur="orgao_local" placeholder="Ex: 3ª Vara Cível / Delegacia Central" class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('orgao_local') border-red-500 @else border-slate-300 @enderror">
            @error('orgao_local') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="autor_atentado" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Autor do Atentado (Nome/Cargo)</label>
            <input type="text" id="autor_atentado" wire:model="autor_atentado" placeholder="Ex: Juiz de Direito X / Delegado Y" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
          </div>

          <div>
            <label for="processo_num" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Nº do Processo / Autos (se houver)</label>
            <input type="text" id="processo_num" wire:model="processo_num" placeholder="0000000-00.2026.8.26.0000" class="w-full p-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D]">
          </div>
        </div>

        <div>
          <label for="descricao_fatos" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Relato Detalhado dos Fatos *</label>
          <textarea id="descricao_fatos" wire:model.blur="descricao_fatos" rows="5" placeholder="Descreva sucintamente como ocorreu o cerceamento de defesa..." class="w-full p-3 border rounded-lg text-xs outline-none focus:border-[#17344D] @error('descricao_fatos') border-red-500 @else border-slate-300 @enderror"></textarea>
          @error('descricao_fatos') <span class="text-[10px] text-red-500 font-semibold">{{ $message }}</span> @enderror
        </div>
      </div>

      <!-- BOTÃO SUBMIT LIVEWIRE -->
      <div class="pt-2">
        <button type="submit" wire:loading.attr="disabled" class="w-full bg-[#C6282D] hover:bg-red-700 disabled:opacity-50 text-white font-bold py-4 px-6 rounded-xl text-xs uppercase shadow-xl transition-all flex items-center justify-center gap-2">
          <span wire:loading.remove><i class="fa-solid fa-shield-halved text-base mr-1"></i> Transmitir Acionamento para a Comissão de Prerrogativas</span>
          <span wire:loading><i class="fa-solid fa-circle-notch fa-spin text-base mr-1"></i> Transmitindo com Urgência...</span>
        </button>
      </div>

    </form>
  @endif
</div>
