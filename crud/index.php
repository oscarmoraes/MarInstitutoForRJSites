<?php
require_once __DIR__.'/db.php';

// Busca o simpósio ativo ou selecionado via GET (ex: ?slug=simposio-sp ou ?id=1)
$eventSlug = trim($_GET['slug'] ?? $_GET['e'] ?? '');
$eventId = (int) ($_GET['id'] ?? 0);

$event = null;
if (! empty($eventSlug)) {
    $stmtEvent = $pdo->prepare('SELECT * FROM `simposio_eventos` WHERE `slug` = :slug LIMIT 1');
    $stmtEvent->execute([':slug' => $eventSlug]);
    $event = $stmtEvent->fetch();
} elseif ($eventId > 0) {
    $stmtEvent = $pdo->prepare('SELECT * FROM `simposio_eventos` WHERE `id` = :id LIMIT 1');
    $stmtEvent->execute([':id' => $eventId]);
    $event = $stmtEvent->fetch();
}

if (! $event) {
    // Busca o primeiro simpósio ativo do banco de dados
    $stmtEvent = $pdo->query('SELECT * FROM `simposio_eventos` WHERE `ativo` = 1 ORDER BY `id` ASC LIMIT 1');
    $event = $stmtEvent->fetch();
}

// Fallback padrão se não houver nenhum cadastrado ainda
if (! $event) {
    $event = [
        'id' => 1,
        'slug' => 'simposio-2026',
        'titulo' => 'Simpósio Instituto MAR',
        'data_evento' => '2026-11-11 09:00:00',
        'vagas_totais' => 30,
    ];
}

$simposioId = (int) $event['id'];
$tituloEvento = htmlspecialchars($event['titulo']);
$vagasTotais = (int) $event['vagas_totais'];
$dataEventoRaw = $event['data_evento'];

// Format Data para Exibição
$dateTimeObj = new DateTime($dataEventoRaw);
$dataEventoFormatada = $dateTimeObj->format('d/m/Y');
$dataEventoISO = $dateTimeObj->format('Y-m-d H:i:s');

// Busca inscritos confirmados deste simpósio
$totalInscritos = 0;
try {
    $stmtCount = $pdo->prepare("SELECT COUNT(*) as total FROM `simposio_inscritos` WHERE `simposio_id` = :sid AND `status` = 'confirmado'");
    $stmtCount->execute([':sid' => $simposioId]);
    $totalInscritos = (int) $stmtCount->fetch()['total'];
} catch (Exception $e) {
    $totalInscritos = 0;
}

$vagasRestantes = max(0, $vagasTotais - $totalInscritos);
$porcentagemPreenchida = min(100, round(($totalInscritos / $vagasTotais) * 100, 1));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $tituloEvento; ?> - Instituto MAR | <?php echo $dataEventoFormatada; ?></title>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts: Montserrat -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Inputs Ocultos de Configuração Dinâmica -->
  <input type="hidden" id="targetEventDate" value="<?php echo $dataEventoISO; ?>">
  <input type="hidden" id="simposioId" value="<?php echo $simposioId; ?>">

  <!-- Top Info Bar -->
  <div class="top-bar">
    <div class="container">
      <div class="social-links">
        <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
        <span style="color:#CBD5E1; margin: 0 5px;">|</span>
        <span class="top-bar-text">MAR NO SEU ESTADO</span>
      </div>
      <div class="top-bar-right">
        <a href="admin/" class="btn-solid-red-sm" style="background:#14213D; border-color:#14213D;"><i class="fa-solid fa-lock"></i> PAINEL ADMIN</a>
        <a href="#" class="btn-solid-red-sm btn-open-modal">INSCREVER-SE</a>
      </div>
    </div>
  </div>

  <!-- Red Navigation Bar (Instituto MAR Visual) -->
  <nav class="main-nav">
    <div class="nav-container">
      <a href="./" class="nav-brand">
        <i class="fa-solid fa-scale-balanced brand-icon"></i>
        <div>
          <div class="brand-text">INSTITUTO MAR</div>
          <span class="brand-subtext">Movimento da Advocacia Renovada</span>
        </div>
      </a>
      <ul class="nav-links">
        <li><a href="#informacoes">INFORMAÇÕES</a></li>
        <li><a href="admin/">PAINEL DE INSCRITOS</a></li>
        <li><a href="#" class="btn-open-modal">INSCREVER-SE</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero">
    <div class="container hero-grid">
      <div class="hero-content">
        <div class="badge-vagas">
          <i class="fa-solid fa-fire"></i> <?php echo $vagasTotais; ?> Vagas Limitadas
        </div>
        <h1 class="hero-title">
          <?php echo $tituloEvento; ?>
          <span>Instituto MAR</span>
        </h1>
        <p class="hero-subtitle">
          Inscrições abertas para o Simpósio. Garanta a sua vaga para o dia <?php echo $dataEventoFormatada; ?>.
        </p>

        <div class="hero-info-pills">
          <div class="info-pill">
            <i class="fa-solid fa-calendar-days"></i>
            <span><?php echo $dataEventoFormatada; ?></span>
          </div>
          <div class="info-pill">
            <i class="fa-solid fa-users"></i>
            <span><?php echo $vagasTotais; ?> Vagas Limitadas</span>
          </div>
        </div>

        <button class="btn-primary-cta btn-open-modal">
          <i class="fa-solid fa-ticket"></i> GARANTIR MINHA VAGA
        </button>
      </div>

      <!-- Hero Right: Countdown Timer Card -->
      <div class="hero-countdown">
        <div class="countdown-card">
          <div class="countdown-card-header">
            <h3>TEMPO RESTANTE PARA O EVENTO:</h3>
            <p><?php echo $dataEventoFormatada; ?></p>
          </div>

          <div class="timer-grid">
            <div class="timer-box">
              <div class="timer-number" id="days">00</div>
              <div class="timer-label">DIAS</div>
            </div>
            <div class="timer-box">
              <div class="timer-number" id="hours">00</div>
              <div class="timer-label">HORAS</div>
            </div>
            <div class="timer-box">
              <div class="timer-number" id="minutes">00</div>
              <div class="timer-label">MINUTOS</div>
            </div>
            <div class="timer-box">
              <div class="timer-number" id="seconds">00</div>
              <div class="timer-label">SEGUNDOS</div>
            </div>
          </div>

          <button class="btn-primary-cta btn-open-modal" style="width: 100%; margin-bottom: 20px;">
            INSCREVER-SE AGORA
          </button>

          <!-- Scarcity indicator dynamic from MySQL -->
          <div class="scarcity-progress-container">
            <div class="scarcity-text">
              <span>Vagas Preenchidas:</span>
              <strong id="scarcityCount"><?php echo $totalInscritos; ?> / <?php echo $vagasTotais; ?> Vagas</strong>
            </div>
            <div class="progress-bar-bg">
              <div class="progress-bar-fill" style="width: <?php echo $porcentagemPreenchida; ?>%;"></div>
            </div>
            <div style="font-size: 0.8rem; color: #FF8087; text-align: right; margin-top: 6px; font-weight: 600;">
              <i class="fa-solid fa-circle-exclamation"></i> Restam apenas <?php echo $vagasRestantes; ?> vagas!
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Informações Section -->
  <section id="informacoes" class="section">
    <div class="container">
      <div class="section-title">
        <h2><?php echo $tituloEvento; ?></h2>
        <p>Inscreva-se para garantir sua vaga no dia <?php echo $dataEventoFormatada; ?>.</p>
      </div>

      <div class="about-grid">
        <div class="about-card">
          <h3>Informações do Evento</h3>
          <ul class="feature-list">
            <li><i class="fa-solid fa-calendar-check"></i> <strong>Data:</strong> <?php echo $dataEventoFormatada; ?></li>
            <li><i class="fa-solid fa-users"></i> <strong>Vagas:</strong> <?php echo $vagasTotais; ?> vagas limitadas</li>
            <li><i class="fa-solid fa-building"></i> <strong>Realização:</strong> Instituto MAR</li>
          </ul>
        </div>

        <div class="about-card" style="border-top-color: var(--color-navy-dark); text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center;">
          <h3 style="margin-bottom: 15px;">Garanta sua Vaga</h3>
          <p style="margin-bottom: 25px;">Preencha seu nome e telefone WhatsApp no formulário de inscrição.</p>
          <button class="btn-primary-cta btn-open-modal" style="width: 100%; max-width: 320px;">
            INSCREVER-SE
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="cta-banner-section">
    <div class="container">
      <div class="cta-banner-content">
        <h3><?php echo $tituloEvento; ?> - <?php echo $dataEventoFormatada; ?></h3>
        <p><?php echo $vagasTotais; ?> Vagas Limitadas.</p>
        <button class="btn-primary-cta btn-open-modal">
          <i class="fa-solid fa-ticket"></i> GARANTIR VAGA
        </button>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col footer-about">
          <h5>INSTITUTO MAR</h5>
          <p>
            Instituto MAR - Movimento da Advocacia Renovada.
          </p>
          <div class="social-links">
            <a href="#" style="color:#FFF;"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" style="color:#FFF;"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" style="color:#FFF;"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div class="footer-col">
          <h5>EVENTO</h5>
          <ul class="footer-links">
            <li><a href="#informacoes">Informações</a></li>
            <li><a href="admin/">Painel Admin</a></li>
          </ul>
        </div>

        <div class="footer-col footer-contact-info">
          <h5>CONTATO</h5>
          <p><i class="fa-solid fa-location-dot"></i> Av. Rio Branco, 1 - Centro, Rio de Janeiro - RJ</p>
          <p><i class="fa-solid fa-envelope"></i> contato@mar-instituto.org.br</p>
        </div>
      </div>

      <div class="footer-bottom">
        &copy; 2026 Instituto MAR. Todos os direitos reservados.
      </div>
    </div>
  </footer>

  <!-- Lead Capture Modal -->
  <div class="modal-backdrop" id="modalLeadCapture">
    <div class="modal-box">
      <div class="modal-header">
        <button class="modal-close-btn" id="modalCloseBtn" aria-label="Fechar">&times;</button>
        <h3>Inscrição no Simpósio</h3>
        <p><?php echo $dataEventoFormatada; ?> &bull; <?php echo $vagasTotais; ?> Vagas Limitadas</p>
      </div>

      <div class="modal-body">
        <!-- Form State View -->
        <div id="modalFormView">
          <form id="leadCaptureForm" novalidate>
            <div class="form-group">
              <label for="userName">Nome Completo *</label>
              <div class="form-control-wrap">
                <i class="fa-solid fa-user"></i>
                <input type="text" id="userName" class="form-control" placeholder="Digite seu nome completo" required>
              </div>
              <div class="form-error-msg" id="nameError">Por favor, insira seu nome completo.</div>
            </div>

            <div class="form-group">
              <label for="userPhone">Telefone WhatsApp *</label>
              <div class="form-control-wrap">
                <i class="fa-brands fa-whatsapp"></i>
                <input type="tel" id="userPhone" class="form-control" placeholder="(00) 00000-0000" maxlength="15" required>
              </div>
              <div class="form-error-msg" id="phoneError">Por favor, informe seu WhatsApp com DDD.</div>
            </div>

            <button type="submit" class="btn-submit-modal">
              <i class="fa-solid fa-check-circle"></i> CONFIRMAR INSCRIÇÃO
            </button>
          </form>
        </div>

        <!-- Success Confirmation State View -->
        <div id="modalSuccessView" class="modal-success-screen">
          <div class="success-icon-ring">
            <i class="fa-solid fa-check"></i>
          </div>
          <h4>Você está Inscrito(a)!</h4>
          <p>
            Parabéns, <strong id="subscriberNameSpan" style="color: var(--color-primary-red);">Participante</strong>! Sua inscrição para o <strong><?php echo $tituloEvento; ?></strong> foi realizada com sucesso.
          </p>

          <div class="success-ticket-box">
            <div class="ticket-item">
              <span>Evento:</span>
              <strong><?php echo $tituloEvento; ?></strong>
            </div>
            <div class="ticket-item">
              <span>Data do Evento:</span>
              <strong><?php echo $dataEventoFormatada; ?></strong>
            </div>
            <div class="ticket-item">
              <span>Status:</span>
              <strong style="color: #0E9F6E;"><i class="fa-solid fa-circle-check"></i> Inscrito</strong>
            </div>
          </div>

          <button class="btn-finish-modal" id="modalFinishBtn">
            CONCLUÍDO
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript file -->
  <script src="js/script.js"></script>
</body>
</html>
