<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo — Instituto MAR</title>
  
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
<body class="bg-gradient-to-br from-[#0F2334] via-[#17344D] to-[#0F2334] min-h-screen flex items-center justify-center p-4">

  <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-200">
    
    <!-- Cabeçalho do Card -->
    <div class="bg-[#17344D] text-white p-8 text-center border-b-4 border-[#C6282D] space-y-3">
      <img src="{{ asset('assets/images/logo-mar.png') }}" alt="Instituto MAR" class="h-10 w-auto bg-white p-2 rounded-lg mx-auto shadow-sm">
      <div class="text-xs uppercase tracking-widest text-slate-300 font-bold">ÁREA RESTRITA</div>
      <h1 class="font-title font-extrabold text-xl">Painel de Gestão Institucional</h1>
    </div>

    <!-- Formulário de Login -->
    <form action="{{ route('admin.dashboard') }}" method="GET" class="p-8 space-y-5">
      <div>
        <label for="user" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Usuário / E-mail</label>
        <div class="relative">
          <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
          <input type="text" id="user" required value="admin" class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] focus:ring-1 focus:ring-[#17344D]">
        </div>
      </div>

      <div>
        <label for="password" class="block text-xs font-bold text-[#17344D] uppercase mb-1">Senha de Acesso</label>
        <div class="relative">
          <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
          <input type="password" id="password" required value="••••••••" class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-xs outline-none focus:border-[#17344D] focus:ring-1 focus:ring-[#17344D]">
        </div>
      </div>

      <button type="submit" class="w-full bg-[#C6282D] hover:bg-red-700 text-white font-title font-bold text-xs py-3.5 px-4 rounded-lg transition-colors shadow-lg flex items-center justify-center gap-2">
        <i class="fa-solid fa-right-to-bracket"></i> Acessar Painel Principal
      </button>

      <div class="pt-4 border-t border-slate-100 text-center">
        <a href="{{ route('home') }}" class="text-xs font-bold text-slate-500 hover:text-[#17344D]">
          <i class="fa-solid fa-arrow-left mr-1"></i> Voltar ao Portal Público
        </a>
      </div>
    </form>

  </div>

</body>
</html>
