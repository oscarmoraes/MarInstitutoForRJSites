<div class="min-h-screen text-slate-800">

    @if ($showSuccessMessage)
    <div class="rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm font-medium">
        <h2 class="text-lg font-bold mb-1">Cadastro realizado com sucesso!</h2>
        <p>Obrigado por se associar ao Instituto MAR. Em breve entraremos em contato com mais informações.</p>
    </div>

    <!-- botão centralizado para recarregar a tela -->
    <div class="flex justify-center mt-6">
        <button wire:click="resetForm" class="px-6 py-3 rounded-lg bg-[#C81D25] hover:bg-[#a3161d] text-white font-bold shadow-lg transition">
            Cadastrar outro associado
        </button>
    </div>
    @else

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-white border-2 border-[#C81D25] rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-[#002060] px-6 py-8 text-center">
                <h2 class="text-3xl font-bold text-white tracking-tight">Ficha de Pedido de Cadastro de Associados</h2>
            </div>

            <form wire:submit.prevent="save" class="px-6 py-8 md:px-10 space-y-8">
                <!-- Dados pessoais -->
                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">1</span>
                        Dados Pessoais
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div class="col-span-1 md:col-span-2 lg:col-span-1">
                            <label class="block text-sm font-semibold text-[#002060] mb-1">Foto*</label>
                            <div class="relative group">
                                <input type="file" wire:model="photo_path" accept="image/*" id="photo_path"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full h-48 rounded-xl border-2 border-dashed border-[#C81D25] bg-slate-50 flex flex-col items-center justify-center text-center p-4 transition group-hover:bg-red-50">
                                    @if ($photo_path)
                                    <img src="{{ $photo_path->temporaryUrl() }}" alt="Preview" class="h-40 w-auto object-cover rounded-lg shadow">
                                    @else
                                    <svg class="w-10 h-10 text-[#C81D25] mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4 4 4 6-6 4 4v4a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                        <circle cx="12" cy="8" r="2"></circle>
                                    </svg>
                                    <span class="text-sm text-[#002060] font-medium">Clique para enviar foto</span>
                                    @endif
                                </div>
                            </div>
                            <div wire:loading wire:target="photo" class="mt-2 text-sm text-[#C81D25] font-medium flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                                Enviando foto...
                            </div>
                            @error('photo_path') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="full_name" class="block text-sm font-semibold text-[#002060] mb-1">Nome completo*</label>
                                <input type="text" id="full_name" wire:model.defer="full_name" placeholder="Nome completo" required
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('full_name') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="cpf" class="block text-sm font-semibold text-[#002060] mb-1">CPF*</label>
                                <input type="text" id="cpf" wire:model.defer="cpf" placeholder="000.000.000-00" x-mask="999.999.999-99" required
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('cpf') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="birth_date" class="block text-sm font-semibold text-[#002060] mb-1">Data de nascimento*</label>
                                <input type="date" id="birth_date" wire:model.defer="birth_date" required
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('birth_date') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-[#002060] mb-1">E-mail*</label>
                                <input type="email" id="email" wire:model.defer="email" placeholder="email@exemplo.com"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('email') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone_primary" class="block text-sm font-semibold text-[#002060] mb-1">Telefone / Celular*</label>
                                <input type="text" id="phone_primary" wire:model.defer="phone_primary" placeholder="(00) 00000-0000" x-mask="(99) 99999-9999" required
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('phone_primary') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone_secondary" class="block text-sm font-semibold text-[#002060] mb-1">Telefone Recado (opcional)</label>
                                <input type="text" id="phone_secondary" wire:model.defer="phone_secondary" placeholder="(00) 00000-0000" x-mask="(99) 99999-9999"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                @error('phone_secondary') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                    {{-- <div class="border-t border-slate-200 my-8">
                            <div>
                                <label class="block text-sm font-semibold text-[#002060] mb-1">Gênero*</label>
                                <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" wire:model.defer="gender" name="gender" value="feminino" class="accent-[#C81D25]">
                                    <span class="text-sm">Feminino</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" wire:model.defer="gender" name="gender" value="masculino" class="accent-[#C81D25]">
                                    <span class="text-sm">Masculino</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" wire:model.defer="gender" name="gender" value="outro" class="accent-[#C81D25]">
                                    <span class="text-sm">Outro</span>
                                </label>
                                </div>
                                @error('gender') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div> --}}
                </section>

                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">1</span>
                        Dados Profissionais
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="oab_number" class="block text-sm font-semibold text-[#002060] mb-1">Número OAB</label>
                            <input type="text" id="oab_number" wire:model.defer="oab_number" placeholder="Número OAB" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('oab_number') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="oab_state_id" class="block text-sm font-semibold text-[#002060] mb-1">UF - OAB</label>
                            <select id="oab_state_id" wire:model.defer="oab_state_id" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition bg-white">
                                <option value="">Selecione</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->letter }}</option>
                                @endforeach
                            </select>
                            @error('oab_state_id') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="phone_office" class="block text-sm font-semibold text-[#002060] mb-1">Telefone Escritório</label>
                            <input type="text" id="phone_office" wire:model.defer="phone_office" placeholder="(00) 00000-0000" x-mask="(99) 99999-9999"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                        </div>
                </section>

                <!-- Endereço -->
                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">2</span>
                        Endereço
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
                        <div class="md:col-span-1">
                            <label for="cep" class="block text-sm font-semibold text-[#002060] mb-1">CEP*</label>
                            <div class="flex gap-2">
                                <input type="text" id="cep" wire:model.defer="cep" placeholder="00000-000" required x-mask="99999-999"
                                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                                <button type="button" wire:click="searchCep" wire:loading.attr="disabled"
                                    class="bg-[#002060] hover:bg-[#001845] text-white px-4 rounded-lg font-semibold transition disabled:opacity-60">
                                    <span wire:loading.remove wire:target="searchCep">Buscar</span>
                                    <span wire:loading wire:target="searchCep">
                                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            @error('cep') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label for="street" class="block text-sm font-semibold text-[#002060] mb-1">Endereço*</label>
                            <input type="text" id="street" wire:model.defer="street" placeholder="Rua, Avenida, etc." required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('street') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
                        <div>
                            <label for="number" class="block text-sm font-semibold text-[#002060] mb-1">Número</label>
                            <input type="text" id="number" wire:model.defer="number" placeholder="Nº"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('number') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="complement" class="block text-sm font-semibold text-[#002060] mb-1">Complemento</label>
                            <input type="text" id="complement" wire:model.defer="complement" placeholder="Apto, Bloco, Sala"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('complement') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="neighborhood" class="block text-sm font-semibold text-[#002060] mb-1">Bairro*</label>
                            <input type="text" id="neighborhood" wire:model.defer="neighborhood" placeholder="Bairro" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 focus:border-[#C81D25] focus:ring-2 focus:ring-[#C81D25]/20 outline-none transition">
                            @error('neighborhood') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
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
                        <div>
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

    

                <!-- LGPD -->
                <section>
                    <h2 class="text-[#002060] text-xl font-bold border-b-2 border-[#C81D25] pb-2 mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#C81D25] text-white text-sm font-bold">5</span>
                        Consentimento LGPD
                    </h2>
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 space-y-4">
                        <p class="text-sm text-slate-700 leading-relaxed">
                            Em conformidade com a Lei Geral de Proteção de Dados Pessoais (Lei nº 13.709/2018), o <strong class="text-[#002060]">Instituto MAR</strong> trata os dados aqui fornecidos com finalidade exclusiva de gestão associativa, comunicação institucional e cumprimento de obrigações legais. Seus dados não serão comercializados.
                        </p>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.defer="lgpd_consent" value="1" class="mt-1 accent-[#C81D25] w-5 h-5">
                            <span class="text-sm text-slate-800">
                                Li e concordo com o uso dos meus dados pessoais para as finalidades descritas acima.
                                <span class="text-[#C81D25] font-semibold">*</span>
                            </span>
                        </label>
                        @error('lgpd_consent') <span class="text-[#C81D25] text-sm font-medium mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </section>

                {{-- Avisar que deu algum erro --}}
                @if ($errors->any())
                <div class="rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm font-medium">
                    Por favor, corrija os erros no formulário antes de enviar.
                    @foreach ($errors->all() as $error)
                    <div class="mt-1">- {{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-col md:flex-row items-center justify-end gap-4 pt-4 border-t border-slate-200">
                    <button type="button" wire:click="resetForm"
                        class="w-full md:w-auto px-6 py-3 rounded-lg border-2 border-[#002060] text-[#002060] font-bold hover:bg-[#002060] hover:text-white transition">
                        Limpar
                    </button>
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full md:w-auto px-8 py-3 rounded-lg bg-[#C81D25] hover:bg-[#a3161d] text-white font-bold shadow-lg transition disabled:opacity-70 flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="save">Finalizar cadastro</span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            Salvando...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>