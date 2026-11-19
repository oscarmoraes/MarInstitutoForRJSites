
<section id="servicos" class="w-full border-t border-[#d8e0e6] bg-white py-24 lg:py-28">

    <div class="mx-auto max-w-[1370px] px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[280px_1fr] lg:gap-12">

            {{-- IDENTIFICAÇÃO --}}
            <div class="pt-2">
                <span class="text-[11px] font-bold uppercase tracking-[2px] text-[#d3262e]">
                    06 / Serviços
                </span>
            </div>

            {{-- CONTEÚDO --}}
            <div class="max-w-[980px]">

                {{-- TÍTULO --}}
                <h2 class="text-[38px] font-bold leading-[1.12] tracking-[-1.8px] text-[#193650] sm:text-[48px] lg:text-[46px]">
                    Especialidades que se somam
                    <br class="hidden sm:block">
                    ao atendimento do escritório.
                </h2>

                {{-- DESCRIÇÃO --}}
                <p class="mt-7 max-w-[850px] text-[14px] leading-[1.8] text-[#53677b] sm:text-[15px]">
                    Na proposta do MAR, seu escritório passa a apresentar estas
                    soluções aos clientes por meio da rede credenciada.
                    Você mantém o foco nos serviços jurídicos; o parceiro
                    executa a especialidade e o MAR acompanha a entrega.
                </p>

                {{-- LAYOUT DOS SERVIÇOS --}}
                <div class="mt-10 grid grid-cols-1 items-start gap-8 md:grid-cols-[1fr_1.15fr] md:gap-8 lg:gap-9">

                    {{-- ABAS --}}
                    <div
                        class="flex flex-col"
                        role="tablist"
                        aria-label="Categorias de serviços"
                        aria-orientation="vertical"
                        id="service-tabs"
                    >

                        {{-- ABA 01 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-franquias"
                            aria-controls="service-panel"
                            aria-selected="false"
                            tabindex="-1"
                            data-service="franquias"
                            class="service-tab flex w-full items-center gap-5 border-b border-[#d8e0e6] px-3 py-5 text-left transition hover:bg-[#f3f5f7]"
                        >
                            <span class="text-[11px] text-[#718194]">01</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#315879]">
                                Formatação de franquias
                            </span>
                            <span class="text-[13px] text-[#315879]">↗</span>
                        </button>

                        {{-- ABA 02 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-marketing"
                            aria-controls="service-panel"
                            aria-selected="false"
                            tabindex="-1"
                            data-service="marketing"
                            class="service-tab flex w-full items-center gap-5 border-b border-[#d8e0e6] px-3 py-5 text-left transition hover:bg-[#f3f5f7]"
                        >
                            <span class="text-[11px] text-[#718194]">02</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#315879]">
                                Marketing
                            </span>
                            <span class="text-[13px] text-[#315879]">↗</span>
                        </button>

                        {{-- ABA 03 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-contabilidade"
                            aria-controls="service-panel"
                            aria-selected="true"
                            tabindex="0"
                            data-service="contabilidade"
                            class="service-tab active flex w-full items-center gap-5 border-b border-[#d8e0e6] border-l-[3px] border-l-[#d3262e] bg-[#f3f5f7] px-3 py-5 text-left"
                        >
                            <span class="text-[11px] text-[#d3262e]">03</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#193650]">
                                Contabilidade e finanças
                            </span>
                            <span class="text-[13px] text-[#d3262e]">↗</span>
                        </button>

                        {{-- ABA 04 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-marcas"
                            aria-controls="service-panel"
                            aria-selected="false"
                            tabindex="-1"
                            data-service="marcas"
                            class="service-tab flex w-full items-center gap-5 border-b border-[#d8e0e6] px-3 py-5 text-left transition hover:bg-[#f3f5f7]"
                        >
                            <span class="text-[11px] text-[#718194]">04</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#315879]">
                                Registro de marcas no INPI
                            </span>
                            <span class="text-[13px] text-[#315879]">↗</span>
                        </button>

                        {{-- ABA 05 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-pessoas"
                            aria-controls="service-panel"
                            aria-selected="false"
                            tabindex="-1"
                            data-service="pessoas"
                            class="service-tab flex w-full items-center gap-5 border-b border-[#d8e0e6] px-3 py-5 text-left transition hover:bg-[#f3f5f7]"
                        >
                            <span class="text-[11px] text-[#718194]">05</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#315879]">
                                Gestão de pessoas
                            </span>
                            <span class="text-[13px] text-[#315879]">↗</span>
                        </button>

                        {{-- ABA 06 --}}
                        <button
                            type="button"
                            role="tab"
                            id="tab-tecnologia"
                            aria-controls="service-panel"
                            aria-selected="false"
                            tabindex="-1"
                            data-service="tecnologia"
                            class="service-tab flex w-full items-center gap-5 border-b border-[#d8e0e6] px-3 py-5 text-left transition hover:bg-[#f3f5f7]"
                        >
                            <span class="text-[11px] text-[#718194]">06</span>
                            <span class="flex-1 text-[14px] font-semibold text-[#315879]">
                                Tecnologia e dados
                            </span>
                            <span class="text-[13px] text-[#315879]">↗</span>
                        </button>

                    </div>

                    {{-- PAINEL DINÂMICO --}}
                    <article
                        id="service-panel"
                        role="tabpanel"
                        aria-labelledby="tab-contabilidade"
                        tabindex="0"
                        class="relative border-b-[3px] border-[#d3262e] bg-[#f3f5f7] p-7 sm:p-8"
                    >

                        <p
                            id="service-tag"
                            class="text-[12px] font-bold uppercase tracking-[2px] text-[#d3262e]"
                        >
                            Gestão e indicadores
                        </p>

                        <h3
                            id="service-title"
                            class="mt-5 text-[25px] font-semibold leading-tight tracking-tight text-[#193650] sm:text-[27px]"
                        >
                            Contabilidade e finanças
                        </h3>

                        <p
                            id="service-desc"
                            class="mt-4 text-[14px] leading-[1.8] text-[#193650]"
                        >
                            Para clientes que precisam organizar as contas e
                            compreender melhor a situação financeira da empresa.
                        </p>

                        <dl class="mt-7 space-y-5">

                            <div>
                                <dt class="text-[10px] font-medium uppercase tracking-[1px] text-[#718194]">
                                    Quem entrega
                                </dt>
                                <dd
                                    id="service-who"
                                    class="mt-2 text-[13px] leading-[1.7] text-[#315879]"
                                >
                                    Profissionais habilitados, com atendimento
                                    a distância e suporte regional conforme
                                    a necessidade.
                                </dd>
                            </div>

                            <div>
                                <dt class="text-[10px] font-medium uppercase tracking-[1px] text-[#718194]">
                                    O que seu escritório passa a oferecer
                                </dt>
                                <dd
                                    id="service-offer"
                                    class="mt-2 text-[13px] leading-[1.7] text-[#315879]"
                                >
                                    Acesso a serviços contábeis, gestão de contas
                                    a pagar e a receber e relatórios financeiros,
                                    executados por profissionais especializados.
                                </dd>
                            </div>

                            <div>
                                <dt class="text-[10px] font-medium uppercase tracking-[1px] text-[#718194]">
                                    O benefício para seu escritório
                                </dt>
                                <dd
                                    id="service-gain"
                                    class="mt-2 text-[13px] font-semibold leading-[1.7] text-[#193650]"
                                >
                                    Você conecta o cliente a apoio contábil e
                                    financeiro que complementa o atendimento
                                    jurídico e ajuda a organizar as informações
                                    da empresa.
                                </dd>
                            </div>

                            <div>
                                <dt class="text-[10px] font-medium uppercase tracking-[1px] text-[#718194]">
                                    Valor e contratação
                                </dt>
                                <dd
                                    id="service-price"
                                    class="mt-2 text-[13px] leading-[1.7] text-[#315879]"
                                >
                                    Orçamento conforme o porte da empresa,
                                    o volume de trabalho e a complexidade
                                    da operação.
                                </dd>
                            </div>

                        </dl>

                    </article>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- JAVASCRIPT DAS ABAS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.service-tab');
    const panel = document.getElementById('service-panel');

    if (!tabs.length || !panel) return;

    const services = {

        contabilidade: {
            tag: 'Gestão e indicadores',
            title: 'Contabilidade e finanças',
            desc: 'Para clientes que precisam organizar as contas e compreender melhor a situação financeira da empresa.',
            who: 'Profissionais habilitados, com atendimento a distância e suporte regional conforme a necessidade.',
            offer: 'Acesso a serviços contábeis, gestão de contas a pagar e a receber e relatórios financeiros, executados por profissionais especializados.',
            gain: 'Você conecta o cliente a apoio contábil e financeiro que complementa o atendimento jurídico e ajuda a organizar as informações da empresa.',
            price: 'Orçamento conforme o porte da empresa, o volume de trabalho e a complexidade da operação.'
        },

        // Os demais conteúdos serão preenchidos com os textos
        // originais de cada serviço.

        franquias: {
            tag: 'Expansão Empresarial',
            title: 'Formatação de franquias',
            desc: 'Para clientes que querem avaliar a expansão de uma empresa pelo modelo de franquias.',
            who: 'Consultoria especializada em franquias, com atendimento nacional e apoio local quando necessário.',
            offer: 'Consultoria para transformar empresas em franquias: análise de viabilidade, estruturação do modelo de negócio, processos, manuais e planejamento da expansão.',
            gain: 'Você pode acompanhar uma nova etapa do negócio do cliente com apoio de especialistas, mantendo seu foco na atuação jurídica.',
            price: 'R$ 40 mil no exemplo do projeto. O preço de cada proposta depende dos serviços e das entregas contratadas.'
        },

        marketing: {
            tag: 'Marketing e posicionamento',
            title: 'Marketing',
            desc: 'Conteúdo do serviço a definir.',
            who: 'Conteúdo a definir.',
            offer: 'Conteúdo a definir.',
            gain: 'Conteúdo a definir.',
            price: 'Condições comerciais a definir.'
        },

        marcas: {
            tag: 'Proteção e propriedade intelectual',
            title: 'Registro de marcas no INPI',
            desc: 'Conteúdo do serviço a definir.',
            who: 'Conteúdo a definir.',
            offer: 'Conteúdo a definir.',
            gain: 'Conteúdo a definir.',
            price: 'Condições comerciais a definir.'
        },

        pessoas: {
            tag: 'Gestão e desenvolvimento',
            title: 'Gestão de pessoas',
            desc: 'Conteúdo do serviço a definir.',
            who: 'Conteúdo a definir.',
            offer: 'Conteúdo a definir.',
            gain: 'Conteúdo a definir.',
            price: 'Condições comerciais a definir.'
        },

        tecnologia: {
            tag: 'Inovação e tecnologia',
            title: 'Tecnologia e dados',
            desc: 'Conteúdo do serviço a definir.',
            who: 'Conteúdo a definir.',
            offer: 'Conteúdo a definir.',
            gain: 'Conteúdo a definir.',
            price: 'Condições comerciais a definir.'
        }

    };

    function activateTab(tab, moveFocus = false) {

        const service = services[tab.dataset.service];

        if (!service) return;

        // Atualiza o estado visual e acessibilidade
        tabs.forEach(item => {

            const active = item === tab;

            item.setAttribute('aria-selected', active ? 'true' : 'false');
            item.setAttribute('tabindex', active ? '0' : '-1');

            item.classList.toggle('active', active);
            item.classList.toggle('bg-[#f3f5f7]', active);
            item.classList.toggle('border-l-[3px]', active);
            item.classList.toggle('border-l-[#d3262e]', active);

            item.classList.toggle('text-[#193650]', active);

        });

        // Atualiza o painel
        const fields = {
            'service-tag': 'tag',
            'service-title': 'title',
            'service-desc': 'desc',
            'service-who': 'who',
            'service-offer': 'offer',
            'service-gain': 'gain',
            'service-price': 'price'
        };

        Object.entries(fields).forEach(([id, key]) => {
            document.getElementById(id).textContent = service[key];
        });

        panel.setAttribute('aria-labelledby', tab.id);

        if (moveFocus) {
            tab.focus();
        }

    }

    // Clique nas abas
    tabs.forEach(tab => {

        tab.addEventListener('click', function () {
            activateTab(this);
        });

        // Navegação pelo teclado
        tab.addEventListener('keydown', function (event) {

            const currentIndex = Array.from(tabs).indexOf(this);
            let nextIndex = currentIndex;

            if (event.key === 'ArrowDown' || event.key === 'ArrowRight') {
                nextIndex = (currentIndex + 1) % tabs.length;
            }

            if (event.key === 'ArrowUp' || event.key === 'ArrowLeft') {
                nextIndex = (currentIndex - 1 + tabs.length) % tabs.length;
            }

            if (event.key === 'Home') {
                nextIndex = 0;
            }

            if (event.key === 'End') {
                nextIndex = tabs.length - 1;
            }

            if (nextIndex !== currentIndex) {
                event.preventDefault();
                activateTab(tabs[nextIndex], true);
            }

        });

    });

});
</script>
