
<section id="simulacao" class="bg-white py-24 lg:py-32">
    <div class="mx-auto max-w-[1240px] px-6 lg:px-10">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

            <!-- Identificação da seção -->
            <div class="lg:col-span-3">
                <span class="text-[11px] font-semibold uppercase tracking-[0.16em] text-[#c9272c]">
                    09 / Simule os cenários
                </span>
            </div>

            <!-- Conteúdo -->
            <div class="lg:col-span-9">

                <h2 class="max-w-[750px] text-4xl font-semibold leading-[1.12] tracking-[-0.045em] text-[#193650] md:text-5xl">
                    Entenda o impacto
                    <br class="hidden md:block">
                    na receita do seu escritório.
                </h2>

                <!-- Abas -->
                <div class="mt-12 flex border-b border-[#d8e0e7]" role="tablist" aria-label="Simulação">

                    <button
                        type="button"
                        id="sim-tab-member"
                        role="tab"
                        aria-selected="true"
                        aria-controls="sim-member"
                        class="sim-tab border-b-2 border-[#c9272c] px-6 py-4 text-sm font-semibold text-[#193650]"
                    >
                        Associado
                    </button>

                    <button
                        type="button"
                        id="sim-tab-network"
                        role="tab"
                        aria-selected="false"
                        aria-controls="sim-network"
                        class="sim-tab border-b-2 border-transparent px-6 py-4 text-sm font-medium text-[#53677b]"
                    >
                        Operação da rede
                    </button>

                </div>

                <!-- CONTEÚDO: ASSOCIADO -->
                <div
                    id="sim-member"
                    role="tabpanel"
                    aria-labelledby="sim-tab-member"
                    class="sim-content grid grid-cols-1 gap-10 pt-8 md:grid-cols-2 lg:gap-12"
                >

                    <!-- Inputs -->
                    <div class="space-y-7">

                        <div>
                            <label for="contracts" class="mb-4 flex items-center justify-between gap-3 text-sm font-medium text-[#193650]">
                                <span>Serviços com remuneração permitida e recebida no mês</span>
                                <output id="contracts-label" class="text-lg font-semibold text-[#c9272c]">2</output>
                            </label>

                            <input
                                id="contracts"
                                type="range"
                                min="0"
                                max="10"
                                step="1"
                                value="2"
                                class="sim-range"
                            >
                        </div>

                        <div>
                            <label for="commission" class="mb-2 block text-sm font-medium text-[#193650]">
                                Valor recebido por serviço (R$)
                            </label>

                            <input
                                id="commission"
                                type="number"
                                min="0"
                                max="50000"
                                step="50"
                                value="500"
                                class="sim-number"
                            >
                        </div>

                        <div>
                            <label for="fee" class="mb-2 block text-sm font-medium text-[#193650]">
                                Mensalidade (R$)
                            </label>

                            <input
                                id="fee"
                                type="number"
                                min="0"
                                max="10000"
                                step="50"
                                value="500"
                                class="sim-number"
                            >
                        </div>

                        <button
                            type="button"
                            id="reset-member"
                            class="border-b border-[#193650] pb-1 text-xs text-[#315675] transition hover:text-[#c9272c]"
                        >
                            Restaurar exemplo
                        </button>

                    </div>

                    <!-- Resultado -->
                    <div class="bg-[#f3f5f7] p-7 md:p-8">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#c9272c]">
                            Saldo após a mensalidade
                        </p>

                        <strong
                            id="member-net"
                            class="mt-6 block text-4xl font-semibold tracking-[-0.04em] text-[#193650] md:text-5xl"
                        >
                            R$ 500
                        </strong>

                        <dl class="mt-8 space-y-0 text-xs text-[#315675]">

                            <div class="flex items-center justify-between gap-4 border-b border-[#d3dce4] py-4">
                                <dt>Receita bruta adicional</dt>
                                <dd id="member-gross" class="font-semibold">R$ 1.000</dd>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-[#d3dce4] py-4">
                                <dt>Mensalidade</dt>
                                <dd id="member-fee" class="font-semibold">R$ 500</dd>
                            </div>

                        </dl>

                        <p id="member-breakeven" class="mt-5 text-xs leading-5 text-[#315675]">
                            1 serviço remunerado cobre a mensalidade, antes de impostos e despesas.
                        </p>

                    </div>

                </div>

                <p id="member-note" class="mt-7 max-w-[850px] text-xs leading-6 text-[#607286]">
                    Exemplo: dois serviços que gerem R$ 500 cada para o associado somam R$ 1.000. Após a mensalidade de R$ 500, restam R$ 500, antes de impostos e despesas. A simulação considera remuneração permitida e contratada; não garante recebimentos mensais. O plano também entrega valor por meio de formação, posicionamento e apoio à rotina.
                </p>


                <!-- CONTEÚDO: OPERAÇÃO DA REDE -->
                <div
                    id="sim-network"
                    role="tabpanel"
                    aria-labelledby="sim-tab-network"
                    class="sim-content hidden grid-cols-1 gap-10 pt-8 md:grid-cols-2 lg:gap-12"
                    hidden
                >

                    <!-- Inputs -->
                    <div class="space-y-7">

                        <div>
                            <label for="members" class="mb-4 flex items-center justify-between gap-3 text-sm font-medium text-[#193650]">
                                <span>Escritórios associados pagantes</span>
                                <output id="members-label" class="text-lg font-semibold text-[#c9272c]">260</output>
                            </label>

                            <input
                                id="members"
                                type="range"
                                min="10"
                                max="500"
                                step="10"
                                value="260"
                                class="sim-range"
                            >
                        </div>

                        <div>
                            <label for="units" class="mb-2 block text-sm font-medium text-[#193650]">
                                Unidades regionais
                            </label>

                            <input
                                id="units"
                                type="number"
                                min="1"
                                max="27"
                                step="1"
                                value="1"
                                class="sim-number"
                            >
                        </div>

                        <div class="border-l-2 border-[#c9272c] pl-4 text-xs leading-6 text-[#607286]">
                            Por escritório: R$ 500 de mensalidade, R$ 50 de reserva estimada para tributos e R$ 150 de custo dos benefícios.

                            <br><br>

                            Custos fixos mensais: R$ 6 mil por unidade e R$ 15 mil da central.
                        </div>

                        <button
                            type="button"
                            id="reset-network"
                            class="border-b border-[#193650] pb-1 text-xs text-[#315675] transition hover:text-[#c9272c]"
                        >
                            Restaurar exemplo
                        </button>

                    </div>

                    <!-- Resultado -->
                    <div class="bg-[#f3f5f7] p-7 md:p-8">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#c9272c]">
                            Saldo estimado da operação
                        </p>

                        <strong
                            id="network-net"
                            class="mt-6 block text-4xl font-semibold tracking-[-0.04em] text-[#193650] md:text-5xl"
                        >
                            R$ 57.000
                        </strong>

                        <dl class="mt-8 space-y-0 text-xs text-[#315675]">

                            <div class="flex items-center justify-between gap-4 border-b border-[#d3dce4] py-4">
                                <dt>Mensalidades brutas</dt>
                                <dd id="network-gross" class="font-semibold">R$ 130.000</dd>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-[#d3dce4] py-4">
                                <dt>Reservas e benefícios</dt>
                                <dd id="network-variable" class="font-semibold">R$ 52.000</dd>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-[#d3dce4] py-4">
                                <dt>Custos fixos</dt>
                                <dd id="network-fixed" class="font-semibold">R$ 21.000</dd>
                            </div>

                        </dl>

                        <p id="network-break" class="mt-5 text-xs leading-5 text-[#315675]">
                            Neste cenário, 70 escritórios associados cobrem os custos considerados.
                        </p>

                    </div>

                </div>

                <p id="network-note" class="mt-7 hidden max-w-[850px] text-xs leading-6 text-[#607286]" hidden>
                    Simulação mensal da operação do instituto e das unidades, sem receitas de parceiros. Não inclui implantação, divulgação para atrair associados, atrasos nos pagamentos, capital de giro ou tributos além da reserva estimada. Essa reserva não representa uma alíquota definida. Dos R$ 300 restantes por mensalidade, a proposta destina R$ 180 à central e R$ 120 à unidade; essa divisão não é um custo extra.
                </p>

            </div>
        </div>
    </div>
</section>

<style>
    .sim-range {
        width: 100%;
        height: 6px;
        appearance: none;
        border-radius: 9999px;
        background: #d9dfe5;
        cursor: pointer;
        accent-color: #c9272c;
    }

    .sim-range::-webkit-slider-thumb {
        appearance: none;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #c9272c;
        cursor: pointer;
    }

    .sim-range::-moz-range-thumb {
        width: 13px;
        height: 13px;
        border: 0;
        border-radius: 50%;
        background: #c9272c;
        cursor: pointer;
    }

    .sim-number {
        width: 100%;
        height: 45px;
        border: 1px solid #cbd5df;
        border-radius: 2px;
        background: #f3f5f7;
        padding: 0 14px;
        font-size: 14px;
        color: #193650;
        outline: none;
        transition: border-color .2s;
    }

    .sim-number:focus {
        border-color: #193650;
    }

    .sim-number::-webkit-inner-spin-button,
    .sim-number::-webkit-outer-spin-button {
        opacity: 1;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const money = value => {
        return Number(value).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL',
            maximumFractionDigits: 0
        });
    };

    const getNumber = (id) => {
        return Math.max(0, Number(document.getElementById(id).value) || 0);
    };

    // ABAS
    const tabs = document.querySelectorAll('.sim-tab');

    function activateTab(tab) {
        const target = tab.getAttribute('aria-controls');

        tabs.forEach(item => {
            const active = item === tab;

            item.setAttribute('aria-selected', active ? 'true' : 'false');

            item.classList.toggle('border-[#c9272c]', active);
            item.classList.toggle('border-transparent', !active);
            item.classList.toggle('font-semibold', active);
            item.classList.toggle('font-medium', !active);
            item.classList.toggle('text-[#193650]', active);
            item.classList.toggle('text-[#53677b]', !active);
        });

        document.querySelectorAll('.sim-content').forEach(panel => {
            const active = panel.id === target;

            panel.hidden = !active;
            panel.classList.toggle('hidden', !active);
            panel.classList.toggle('grid', active);
        });

        document.getElementById('member-note').hidden = target !== 'sim-member';
        document.getElementById('network-note').hidden = target !== 'sim-network';
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => activateTab(tab));

        tab.addEventListener('keydown', event => {
            if (event.key === 'ArrowRight' || event.key === 'ArrowLeft') {
                event.preventDefault();

                const index = Array.from(tabs).indexOf(tab);
                const next = event.key === 'ArrowRight'
                    ? (index + 1) % tabs.length
                    : (index - 1 + tabs.length) % tabs.length;

                tabs[next].focus();
                activateTab(tabs[next]);
            }
        });
    });


    // CALCULADORA DO ASSOCIADO
    const contracts = document.getElementById('contracts');
    const commission = document.getElementById('commission');
    const fee = document.getElementById('fee');

    function calculateMember() {
        const count = getNumber('contracts');
        const value = getNumber('commission');
        const monthlyFee = getNumber('fee');

        const gross = count * value;
        const net = gross - monthlyFee;

        document.getElementById('contracts-label').textContent = count;

        document.getElementById('member-net').textContent = money(net);
        document.getElementById('member-gross').textContent = money(gross);
        document.getElementById('member-fee').textContent = money(monthlyFee);

        const breakEven = value > 0
            ? Math.ceil(monthlyFee / value)
            : null;

        let message;

        if (monthlyFee === 0) {
            message = 'Não há mensalidade a cobrir neste cenário.';
        } else if (breakEven === null) {
            message = 'Informe um valor recebido por serviço para calcular o ponto de equilíbrio.';
        } else if (breakEven === 1) {
            message = '1 serviço remunerado cobre a mensalidade, antes de impostos e despesas.';
        } else {
            message = breakEven + ' serviços remunerados cobrem a mensalidade, antes de impostos e despesas.';
        }

        document.getElementById('member-breakeven').textContent = message;
    }

    [contracts, commission, fee].forEach(input => {
        input.addEventListener('input', calculateMember);
    });

    document.getElementById('reset-member').addEventListener('click', () => {
        contracts.value = 2;
        commission.value = 500;
        fee.value = 500;

        calculateMember();
    });


    // CALCULADORA DA OPERAÇÃO DA REDE
    const members = document.getElementById('members');
    const units = document.getElementById('units');

    function calculateNetwork() {
        const totalMembers = getNumber('members');
        const totalUnits = getNumber('units');

        const gross = totalMembers * 500;
        const variable = totalMembers * 200;
        const fixed = (totalUnits * 6000) + 15000;
        const net = gross - variable - fixed;

        document.getElementById('members-label').textContent = totalMembers;

        document.getElementById('network-net').textContent = money(net);
        document.getElementById('network-gross').textContent = money(gross);
        document.getElementById('network-variable').textContent = money(variable);
        document.getElementById('network-fixed').textContent = money(fixed);

        const breakEven = Math.ceil(fixed / 300);

        let message;

        if (totalMembers >= breakEven) {
            message = 'Neste cenário, ' + breakEven + ' escritórios associados cobrem os custos considerados.';
        } else {
            message = 'São necessários ' + breakEven + ' escritórios associados para cobrir os custos considerados.';
        }

        document.getElementById('network-break').textContent = message;
    }

    [members, units].forEach(input => {
        input.addEventListener('input', calculateNetwork);
    });

    document.getElementById('reset-network').addEventListener('click', () => {
        members.value = 260;
        units.value = 1;

        calculateNetwork();
    });


    // RESULTADOS INICIAIS
    calculateMember();
    calculateNetwork();

});
</script>
