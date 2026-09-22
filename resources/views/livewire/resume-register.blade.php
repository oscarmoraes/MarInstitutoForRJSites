<div class="min-h-screen text-slate-800">

    @if ($showSuccessMessage)
    <div class="rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm font-medium">
        <h2 class="text-lg font-bold mb-1">Cadastro realizado com sucesso!</h2>
        <p>Obrigado por enviar seu currículo ao Instituto MAR.</p>
    </div>

    <div class="flex justify-center mt-6">
        <button wire:click="resetForm" class="px-6 py-3 rounded-lg bg-[#C81D25] hover:bg-[#a3161d] text-white font-bold shadow-lg transition">
            Cadastrar outro currículo
        </button>
    </div>
    @else

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-white border-2 border-[#C81D25] rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-[#002060] px-6 py-8 text-center">
                <h2 class="text-3xl font-bold text-white tracking-tight">Cadastro de Currículo</h2>
            </div>

            <form wire:submit.prevent="save" class="px-6 py-8 md:px-10 space-y-8" enctype="multipart/form-data">
                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">1</span>
                        Dados pessoais
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="nome" class="block text-sm font-semibold text-[#002060] mb-1">Nome completo*</label>
                            <input type="text" id="nome" wire:model.defer="nome" placeholder="Nome completo" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('nome') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#002060] mb-1">E-mail*</label>
                            <input type="email" id="email" wire:model.defer="email" placeholder="email@exemplo.com" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('email') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="telefone" class="block text-sm font-semibold text-[#002060] mb-1">Telefone*</label>
                            <input type="text" id="telefone" wire:model.defer="telefone" placeholder="(00) 00000-0000" x-mask="(99) 99999-9999" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('telefone') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="telefone_contato" class="block text-sm font-semibold text-[#002060] mb-1">Telefone para contato</label>
                            <input type="text" id="telefone_contato" wire:model.defer="telefone_contato" placeholder="(00) 00000-0000" x-mask="(99) 99999-9999"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('telefone_contato') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">2</span>
                        Dados profissionais
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="cargo_atual" class="block text-sm font-semibold text-[#002060] mb-1">Cargo atual*</label>
                            <input type="text" id="cargo_atual" wire:model.defer="cargo_atual" placeholder="Ex: Advogado, Analista Jurídico" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('cargo_atual') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="area_atuacao" class="block text-sm font-semibold text-[#002060] mb-1">Área de atuação*</label>
                            <input type="text" id="area_atuacao" wire:model.defer="area_atuacao" placeholder="Ex: Direito, Comunicação, Marketing" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('area_atuacao') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="areas_interesse" class="block text-sm font-semibold text-[#002060] mb-1">Áreas de interesse</label>
                            <input type="text" id="areas_interesse" wire:model.defer="areas_interesse" placeholder="Ex: Direito empresarial, políticas públicas"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('areas_interesse') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="origem" class="block text-sm font-semibold text-[#002060] mb-1">Origem</label>
                            <select id="origem" wire:model.defer="origem"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition bg-white">
                                <option value="">Selecione</option>
                                <option value="site">Site</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="instagram">Instagram</option>
                                <option value="indicação">Indicação</option>
                                <option value="outros">Outros</option>
                            </select>
                            @error('origem') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="resumo_profissional" class="block text-sm font-semibold text-[#002060] mb-1">Resumo profissional</label>
                        <textarea id="resumo_profissional" wire:model.defer="resumo_profissional" rows="5" placeholder="Descreva sua experiência, especialidades e principais conquistas."
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition resize-none"></textarea>
                        @error('resumo_profissional') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </section>

                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">3</span>
                        Redes e localização
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="linkedin" class="block text-sm font-semibold text-[#002060] mb-1">LinkedIn</label>
                            <input type="url" id="linkedin" wire:model.defer="linkedin" placeholder="https://linkedin.com/in/seu-perfil"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('linkedin') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="instagram" class="block text-sm font-semibold text-[#002060] mb-1">Instagram</label>
                            <input type="text" id="instagram" wire:model.defer="instagram" placeholder="@seuusuario"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('instagram') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="site" class="block text-sm font-semibold text-[#002060] mb-1">Site / Portfolio</label>
                            <input type="url" id="site" wire:model.defer="site" placeholder="https://seusite.com.br"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('site') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="state_id" class="block text-sm font-semibold text-[#002060] mb-1">Estado*</label>
                            <select id="state_id" wire:model.live="state_id" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition bg-white">
                                <option value="">Selecione</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->letter }}</option>
                                @endforeach
                            </select>
                            @error('state_id') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="city_id" class="block text-sm font-semibold text-[#002060] mb-1">Cidade*</label>
                            <select id="city_id" wire:model.live="city_id" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition bg-white">
                                <option value="">Selecione</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->title }}</option>
                                @endforeach
                            </select>
                            @error('city_id') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">4</span>
                        Anexo e mensagem
                    </h2>

                    <div class="space-y-5">
                        <div>
                            <label for="curriculo_arquivo" class="block text-sm font-semibold text-[#002060] mb-1">Currículo (PDF, DOC ou DOCX)*</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="curriculo_arquivo" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-[#C81D25] rounded-2xl cursor-pointer bg-slate-50 hover:bg-red-50 transition-all">
                                    <div class="flex flex-col items-center justify-center text-center px-5">
                                        <svg class="w-10 h-10 text-[#C81D25] mb-3" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16.5V7.5A2.5 2.5 0 019.5 5h5.5L19 9.5v7a2.5 2.5 0 01-2.5 2.5h-8A2.5 2.5 0 016 16.5z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5v5h5"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 13.5h5M9.5 10.5h5"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-[#17344D]">Clique para anexar seu currículo</span>
                                        <span class="text-[11px] text-slate-500 mt-1">Até 10MB</span>
                                    </div>
                                    <input id="curriculo_arquivo" type="file" wire:model="curriculo_arquivo" accept=".pdf,.doc,.docx" class="hidden" required>
                                </label>
                            </div>
                            @if ($curriculo_arquivo)
                                <div class="mt-2 text-sm text-slate-600">
                                    Arquivo selecionado: <span class="font-semibold text-[#002060]">{{ $curriculo_arquivo->getClientOriginalName() }}</span>
                                </div>
                            @endif
                            @error('curriculo_arquivo') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="mensagem" class="block text-sm font-semibold text-[#002060] mb-1">Mensagem</label>
                            <textarea id="mensagem" wire:model.defer="mensagem" rows="5" placeholder="Fale um pouco sobre sua motivação e trajetória profissional."
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition resize-none"></textarea>
                            @error('mensagem') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">5</span>
                        Consentimento LGPD
                    </h2>
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 space-y-4">
                        <p class="text-sm text-slate-700 leading-relaxed">
                            Em conformidade com a Lei Geral de Proteção de Dados Pessoais (Lei nº 13.709/2018), o <strong class="text-[#002060]">Instituto MAR</strong> trata os dados aqui fornecidos com finalidade exclusiva de seleção, comunicação profissional e gestão de processos de recrutamento. Seus dados não serão comercializados.
                        </p>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.defer="lgpd_consentimento" value="1" class="mt-1 accent-[#C81D25] w-5 h-5">
                            <span class="text-sm text-slate-800">
                                Li e concordo com o uso dos meus dados pessoais para as finalidades descritas acima.
                                <span class="text-[#C81D25] font-semibold">*</span>
                            </span>
                        </label>
                        @error('lgpd_consentimento') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </section>

                <input type="hidden" wire:model.defer="status" value="pendente">
                <input type="hidden" wire:model.defer="lgpd_consentimento_em" value="{{ now() }}">
                <input type="hidden" wire:model.defer="politica_privacidade_versao" value="1.0">

                @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm font-medium">
                    Por favor, corrija os erros no formulário antes de enviar.
                    @foreach ($errors->all() as $error)
                    <div class="mt-1">- {{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <div class="flex flex-col md:flex-row items-center justify-end gap-4 pt-4 border-t border-slate-200">
                    <button type="button" wire:click="resetForm"
                        class="w-full md:w-auto px-6 py-3 rounded-lg border-2 border-[#002060] text-[#002060] font-bold hover:bg-[#002060] hover:text-white transition">
                        Limpar
                    </button>
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full md:w-auto px-8 py-3 rounded-lg bg-[#C81D25] hover:bg-[#a3161d] text-white font-bold shadow-lg transition disabled:opacity-70 flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="save">Enviar currículo</span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            Enviando...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
