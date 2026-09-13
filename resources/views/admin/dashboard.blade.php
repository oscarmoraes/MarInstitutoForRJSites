<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Geral — Painel Administrativo MAR</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts: Manrope & Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; }
    h1, h2, h3, .font-title { font-family: 'Manrope', sans-serif; }
  </style>
</head>
<body class="bg-[#F4F6F8] text-[#252B30] min-h-screen flex flex-col md:flex-row">

  <!-- SIDEBAR ADMINISTRATIVA UNIFICADA -->
  <aside class="w-full md:w-64 bg-[#17344D] text-white flex-shrink-0 border-r border-slate-700 flex flex-col justify-between">
    <div>
      <div class="p-6 border-b border-slate-700 flex items-center gap-3">
        <img src="{{ asset('assets/images/logo-mar.png') }}" alt="Instituto MAR" class="h-9 w-auto bg-white p-1.5 rounded">
        <div>
          <div class="font-title font-extrabold text-sm leading-tight">Instituto MAR</div>
          <div class="text-[10px] text-red-400 font-semibold uppercase">Painel Admin (Laravel 11)</div>
        </div>
      </div>

      <nav class="p-4 space-y-1 text-xs font-semibold">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 my-2">Módulos CRUD</div>
        
        <a href="#eventos" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#C6282D] text-white font-bold"><i class="fa-regular fa-calendar-check w-4"></i> 1. Eventos ({{ $stats['events_count'] ?? 0 }})</a>
        <a href="#inscritos" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-user-check w-4"></i> 2. Inscritos ({{ $stats['registrations_count'] ?? 0 }})</a>
        <a href="#noticias" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-newspaper w-4"></i> 3. Notícias ({{ $stats['posts_count'] ?? 0 }})</a>
        <a href="#prerrogativas" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-shield-halved w-4"></i> 4. Denúncias 24h ({{ $stats['claims_count'] ?? 0 }})</a>
        <a href="#associados" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-id-card w-4"></i> 5. Associados ({{ $stats['members_count'] ?? 0 }})</a>
        <a href="#certificados" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-certificate w-4"></i> 6. Certificados ({{ $stats['certificates_count'] ?? 0 }})</a>
        <a href="#atos" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa-solid fa-scroll w-4"></i> 7. Atos Oficiais ({{ $stats['documents_count'] ?? 0 }})</a>
      </nav>
    </div>

    <div class="p-4 border-t border-slate-700 bg-slate-900/50 space-y-2">
      <div class="text-xs text-slate-300 font-bold"><i class="fa-solid fa-user-shield text-red-400 mr-1"></i> Admin MAR</div>
      <a href="{{ route('admin.login') }}" class="block text-center py-2 bg-white/10 hover:bg-white/20 text-white rounded text-xs transition-colors">
        <i class="fa-solid fa-right-from-bracket mr-1"></i> Sair do Painel
      </a>
    </div>
  </aside>

  <!-- ÁREA DE CONTEÚDO DO DASHBOARD -->
  <main class="flex-grow p-6 sm:p-10 space-y-8 overflow-y-auto">
    
    <!-- CABEÇALHO -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-5">
      <div>
        <h1 class="font-title font-extrabold text-2xl text-[#17344D]">Visão Geral do Sistema (Laravel 11)</h1>
        <p class="text-xs text-slate-500">Gestão unificada dos 7 Módulos CRUD do Portal Instituto MAR</p>
      </div>
      <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-[#17344D] hover:bg-slate-800 text-white text-xs font-bold rounded-lg transition-colors flex items-center gap-2">
        <i class="fa-solid fa-globe"></i> Ver Portal Público
      </a>
    </div>

    <!-- CARDS DE MÉTRICAS DINÂMICAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2">
        <div class="flex justify-between items-center text-slate-400 text-xs font-bold">
          <span>INSCRITOS EM EVENTOS</span>
          <i class="fa-regular fa-calendar-check text-[#C6282D] text-lg"></i>
        </div>
        <div class="font-title font-extrabold text-2xl text-[#17344D]">{{ $stats['registrations_count'] ?? 0 }}</div>
        <div class="text-[11px] text-green-700 font-semibold">Registros Ativos no Banco</div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2">
        <div class="flex justify-between items-center text-slate-400 text-xs font-bold">
          <span>NOTÍCIAS & ARTIGOS</span>
          <i class="fa-solid fa-newspaper text-[#17344D] text-lg"></i>
        </div>
        <div class="font-title font-extrabold text-2xl text-[#17344D]">{{ $stats['posts_count'] ?? 0 }}</div>
        <div class="text-[11px] text-slate-500">Publicadas no Portal</div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2">
        <div class="flex justify-between items-center text-slate-400 text-xs font-bold">
          <span>DENÚNCIA PRERROGATIVAS 24H</span>
          <i class="fa-solid fa-shield-halved text-[#C6282D] text-lg"></i>
        </div>
        <div class="font-title font-extrabold text-2xl text-[#17344D]">{{ $stats['claims_count'] ?? 0 }}</div>
        <div class="text-[11px] text-amber-600 font-semibold">Chamados Recebidos</div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2">
        <div class="flex justify-between items-center text-slate-400 text-xs font-bold">
          <span>ASSOCIADOS REGULARES</span>
          <i class="fa-solid fa-id-card text-[#17344D] text-lg"></i>
        </div>
        <div class="font-title font-extrabold text-2xl text-[#17344D]">{{ $stats['members_count'] ?? 0 }}</div>
        <div class="text-[11px] text-slate-500">Com Carteirinha Digital</div>
      </div>
    </div>

    <!-- TABELA DE GERENCIAMENTO DE EVENTOS & INSCRITOS DINÂMICOS -->
    <div id="eventos" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
      <div class="p-5 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
        <div>
          <h2 class="font-title font-bold text-base text-[#17344D]">1. Gestão de Inscrições em Eventos</h2>
          <p class="text-xs text-slate-500">Inscrições recebidas via formulário AJAX do site (Conectado ao BD)</p>
        </div>
        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">
          BD Conectado
        </span>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
          <thead class="bg-slate-100 uppercase text-[10px] font-bold text-slate-500 border-b border-slate-200">
            <tr>
              <th class="p-3.5">ID</th>
              <th class="p-3.5">Nome do Participante</th>
              <th class="p-3.5">OAB / UF</th>
              <th class="p-3.5">WhatsApp</th>
              <th class="p-3.5">Status</th>
              <th class="p-3.5">Data Inscrição</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-medium">
            @forelse($recentRegistrations as $reg)
              <tr class="hover:bg-slate-50">
                <td class="p-3.5">#{{ sprintf('%02d', $reg->id) }}</td>
                <td class="p-3.5 font-bold text-[#17344D]">{{ $reg->nome }}</td>
                <td class="p-3.5">{{ $reg->oab_uf ?? 'N/A' }}</td>
                <td class="p-3.5">{{ $reg->whatsapp }}</td>
                <td class="p-3.5">
                  <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-[10px] font-bold uppercase">
                    {{ $reg->status }}
                  </span>
                </td>
                <td class="p-3.5 text-slate-400">{{ $reg->created_at->format('d/m/Y H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="p-6 text-center text-slate-400">Nenhum inscrito registrado ainda.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- TABELA DE DENÚNCIAS DE PRERROGATIVAS 24H -->
    <div id="prerrogativas" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
      <div class="p-5 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
        <div>
          <h2 class="font-title font-bold text-base text-[#17344D]">2. Plantão 24h — Ocorrências de Prerrogativas</h2>
          <p class="text-xs text-slate-500">Chamados emergenciais transmitidos por advogados</p>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
          <thead class="bg-slate-100 uppercase text-[10px] font-bold text-slate-500 border-b border-slate-200">
            <tr>
              <th class="p-3.5">Protocolo</th>
              <th class="p-3.5">Advogado Requerente</th>
              <th class="p-3.5">OAB</th>
              <th class="p-3.5">Tipo de Violação</th>
              <th class="p-3.5">Órgão / Local</th>
              <th class="p-3.5">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 font-medium">
            @forelse($recentClaims as $claim)
              <tr class="hover:bg-slate-50">
                <td class="p-3.5 font-bold text-[#C6282D]">{{ $claim->protocolo }}</td>
                <td class="p-3.5 font-bold text-[#17344D]">{{ $claim->adv_nome }}</td>
                <td class="p-3.5">{{ $claim->adv_oab }}/{{ $claim->adv_uf }}</td>
                <td class="p-3.5">{{ $claim->tipo_violacao }}</td>
                <td class="p-3.5">{{ $claim->orgao_local }}</td>
                <td class="p-3.5">
                  <span class="px-2 py-1 bg-amber-100 text-amber-800 rounded-full text-[10px] font-bold uppercase">
                    {{ $claim->status }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="p-6 text-center text-slate-400">Nenhum chamado registrado.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>

</body>
</html>
