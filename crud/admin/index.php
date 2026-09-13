<?php
session_start();

// Proteção por Senha
if (! isset($_SESSION['simposio_admin_logged']) || $_SESSION['simposio_admin_logged'] !== true) {
    header('Location: login.php');
    exit;
}

require_once __DIR__.'/../db.php';

$message = '';
$messageType = '';

// ----------------------------------------------------------------------
// READ LISTA DE EVENTOS PARA O SELECT DE FILTRO
// ----------------------------------------------------------------------
$stmtAllEvents = $pdo->query('SELECT * FROM `simposio_eventos` ORDER BY `id` DESC');
$todosEventos = $stmtAllEvents->fetchAll();

// ----------------------------------------------------------------------
// Processamento do CRUD de Inscritos (POST Actions)
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // CREATE: Novo inscrito manualmente
    if ($action === 'create') {
        $nome = trim($_POST['nome'] ?? '');
        $whatsapp = trim($_POST['whatsapp'] ?? '');
        $status = $_POST['status'] ?? 'confirmado';
        $simposioId = (int) ($_POST['simposio_id'] ?? 1);

        if (! empty($nome) && ! empty($whatsapp)) {
            try {
                $stmt = $pdo->prepare('INSERT INTO `simposio_inscritos` (`simposio_id`, `nome`, `whatsapp`, `status`, `created_at`) VALUES (:sid, :nome, :whatsapp, :status, NOW())');
                $stmt->execute([
                    ':sid' => $simposioId,
                    ':nome' => $nome,
                    ':whatsapp' => $whatsapp,
                    ':status' => $status,
                ]);
                $message = 'Inscrito adicionado com sucesso!';
                $messageType = 'success';
            } catch (PDOException $e) {
                $message = 'Erro ao salvar inscrito: '.$e->getMessage();
                $messageType = 'danger';
            }
        } else {
            $message = 'Por favor, preencha todos os campos obrigatórios.';
            $messageType = 'warning';
        }
    }

    // UPDATE: Editar inscrito existente
    if ($action === 'update') {
        $id = (int) ($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $whatsapp = trim($_POST['whatsapp'] ?? '');
        $status = $_POST['status'] ?? 'confirmado';
        $simposioId = (int) ($_POST['simposio_id'] ?? 1);

        if ($id > 0 && ! empty($nome) && ! empty($whatsapp)) {
            try {
                $stmt = $pdo->prepare('UPDATE `simposio_inscritos` SET `simposio_id` = :sid, `nome` = :nome, `whatsapp` = :whatsapp, `status` = :status WHERE `id` = :id');
                $stmt->execute([
                    ':id' => $id,
                    ':sid' => $simposioId,
                    ':nome' => $nome,
                    ':whatsapp' => $whatsapp,
                    ':status' => $status,
                ]);
                $message = 'Registro atualizado com sucesso!';
                $messageType = 'success';
            } catch (PDOException $e) {
                $message = 'Erro ao atualizar registro: '.$e->getMessage();
                $messageType = 'danger';
            }
        }
    }

    // DELETE: Excluir inscrito
    if ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            try {
                $stmt = $pdo->prepare('DELETE FROM `simposio_inscritos` WHERE `id` = :id');
                $stmt->execute([':id' => $id]);
                $message = 'Inscrição removida com sucesso.';
                $messageType = 'info';
            } catch (PDOException $e) {
                $message = 'Erro ao deletar registro: '.$e->getMessage();
                $messageType = 'danger';
            }
        }
    }
}

// ----------------------------------------------------------------------
// READ INSCRITOS
// ----------------------------------------------------------------------
$search = trim($_GET['search'] ?? '');
$filterStatus = $_GET['status_filter'] ?? '';
$filterEvento = (int) ($_GET['evento_filter'] ?? 0);

$sql = '
    SELECT i.*, e.titulo as evento_titulo, e.vagas_totais
    FROM `simposio_inscritos` i
    LEFT JOIN `simposio_eventos` e ON i.simposio_id = e.id
    WHERE 1=1
';
$params = [];

if (! empty($search)) {
    $sql .= ' AND (i.`nome` LIKE :search OR i.`whatsapp` LIKE :search)';
    $params[':search'] = '%'.$search.'%';
}

if (! empty($filterStatus)) {
    $sql .= ' AND i.`status` = :status_filter';
    $params[':status_filter'] = $filterStatus;
}

if ($filterEvento > 0) {
    $sql .= ' AND i.`simposio_id` = :evento_filter';
    $params[':evento_filter'] = $filterEvento;
}

$sql .= ' ORDER BY i.`id` DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$inscritos = $stmt->fetchAll();

// Métricas de Painel
$totalGeral = count($pdo->query('SELECT id FROM `simposio_inscritos`')->fetchAll());
$totalConfirmados = count($pdo->query("SELECT id FROM `simposio_inscritos` WHERE `status` = 'confirmado'")->fetchAll());

// Busca evento selecionado ou principal para exibir métrica de vagas
$stmtMainEv = $pdo->query('SELECT * FROM `simposio_eventos` WHERE `ativo` = 1 ORDER BY `id` ASC LIMIT 1');
$mainEv = $stmtMainEv->fetch();
$vagasTotaisMain = $mainEv ? (int) $mainEv['vagas_totais'] : 30;
$vagasRestantesMain = max(0, $vagasTotaisMain - $totalConfirmados);

$adminName = $_SESSION['simposio_admin_name'] ?? 'Administrador';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel de Inscritos - Simpósio | Instituto MAR</title>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts: Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --color-primary-red: #B81D24;
      --color-navy-dark: #0D1B2A;
      --color-navy-medium: #14213D;
      --color-bg-light: #F8FAFC;
      --color-border: #E2E8F0;
      --color-white: #FFFFFF;
      --font-family: 'Montserrat', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: var(--font-family);
      background-color: var(--color-bg-light);
      color: #334155;
      line-height: 1.6;
    }

    .admin-header {
      background: linear-gradient(135deg, var(--color-navy-dark) 0%, var(--color-navy-medium) 100%);
      color: var(--color-white);
      padding: 18px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 4px solid var(--color-primary-red);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      color: var(--color-white);
      text-decoration: none;
    }

    .admin-brand i { font-size: 1.8rem; color: var(--color-primary-red); }
    .admin-brand h1 { font-size: 1.25rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-nav-tab {
      background: rgba(255, 255, 255, 0.1);
      color: var(--color-white);
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      transition: all 0.2s;
    }
    .btn-nav-tab.active { background: var(--color-primary-red); }
    .btn-nav-tab:hover { background: var(--color-primary-red); }

    .btn-logout {
      background: #DC2626;
      color: var(--color-white);
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 700;
    }

    .admin-container {
      max-width: 1200px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .alert {
      padding: 14px 20px;
      border-radius: 8px;
      margin-bottom: 25px;
      font-weight: 600;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .alert-success { background: #DEF7EC; color: #03543F; border: 1px solid #84E1BC; }
    .alert-danger { background: #FDE8E8; color: #9B1C1C; border: 1px solid #F8B4B4; }
    .alert-warning { background: #FEF08A; color: #713F12; border: 1px solid #FDE047; }
    .alert-info { background: #E1F5FE; color: #0277BD; border: 1px solid #81D4FA; }

    .metrics-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .metric-card {
      background: var(--color-white);
      padding: 24px;
      border-radius: 12px;
      border: 1px solid var(--color-border);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .metric-title { font-size: 0.8rem; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 5px; }
    .metric-value { font-size: 2rem; font-weight: 900; color: var(--color-navy-dark); }

    .metric-icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
    }
    .icon-navy { background: #E2E8F0; color: var(--color-navy-dark); }
    .icon-green { background: #DEF7EC; color: #0E9F6E; }
    .icon-red { background: #FDE8E8; color: var(--color-primary-red); }

    .toolbar-box {
      background: var(--color-white);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid var(--color-border);
      margin-bottom: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .search-form {
      display: flex;
      gap: 10px;
      flex: 1;
    }

    .form-input {
      padding: 10px 14px;
      border: 1.5px solid var(--color-border);
      border-radius: 6px;
      font-size: 0.9rem;
      outline: none;
      font-family: inherit;
    }
    .form-input:focus { border-color: var(--color-primary-red); }

    .btn-action {
      padding: 10px 18px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 700;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }
    .btn-red { background: var(--color-primary-red); color: white; }
    .btn-navy { background: var(--color-navy-dark); color: white; }

    .table-card {
      background: var(--color-white);
      border-radius: 12px;
      border: 1px solid var(--color-border);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th {
      background: #F1F5F9;
      padding: 14px 20px;
      font-size: 0.75rem;
      font-weight: 800;
      text-transform: uppercase;
      color: #475569;
      border-bottom: 1px solid var(--color-border);
    }

    td {
      padding: 16px 20px;
      font-size: 0.9rem;
      border-bottom: 1px solid var(--color-border);
      vertical-align: middle;
    }

    tr:hover { background-color: #F8FAFC; }

    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
    }
    .badge-confirmado { background: #DEF7EC; color: #03543F; }
    .badge-pendente { background: #FEF08A; color: #713F12; }
    .badge-cancelado { background: #FDE8E8; color: #9B1C1C; }

    .btn-sm-edit {
      background: #E2E8F0;
      color: #334155;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      border: none;
      margin-right: 5px;
    }

    .btn-sm-delete {
      background: #FDE8E8;
      color: #9B1C1C;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      border: none;
    }

    .modal-overlay {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(13, 27, 42, 0.75);
      backdrop-filter: blur(4px);
      z-index: 1000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .modal-overlay.active { display: flex; }

    .modal-content {
      background: white;
      border-radius: 12px;
      max-width: 450px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .modal-top {
      background: var(--color-navy-dark);
      color: white;
      padding: 20px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid var(--color-primary-red);
    }
    .modal-top h3 { font-size: 1.1rem; font-weight: 800; text-transform: uppercase; }
    .close-modal-btn { background: none; border: none; color: white; font-size: 1.4rem; cursor: pointer; }

    .modal-body-form { padding: 25px; }
    .form-group-modal { margin-bottom: 18px; }
    .form-group-modal label { display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #475569; }
    select.form-input { background: white; cursor: pointer; }
  </style>
</head>
<body>

  <!-- Admin Header Navigation -->
  <header class="admin-header">
    <a href="index.php" class="admin-brand">
      <i class="fa-solid fa-scale-balanced"></i>
      <div>
        <h1>PAINEL DE INSCRITOS</h1>
        <span style="font-size: 0.7rem; opacity: 0.8; font-weight: 500;">Simpósio - Instituto MAR</span>
      </div>
    </a>
    <div class="header-actions">
      <a href="index.php" class="btn-nav-tab active"><i class="fa-solid fa-users"></i> INSCRITOS</a>
      <a href="eventos.php" class="btn-nav-tab"><i class="fa-solid fa-calendar-days"></i> GERENCIAR SIMPÓSIOS</a>
      <a href="../" class="btn-nav-tab" target="_blank"><i class="fa-solid fa-globe"></i> SITE</a>
      <a href="logout.php" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> SAIR</a>
    </div>
  </header>

  <div class="admin-container">

    <!-- Flash Messages -->
    <?php if (! empty($message)) { ?>
      <div class="alert alert-<?php echo $messageType; ?>">
        <i class="fa-solid fa-info-circle"></i>
        <span><?php echo htmlspecialchars($message); ?></span>
      </div>
    <?php } ?>

    <!-- Dashboard Metric Cards -->
    <div class="metrics-grid">
      <div class="metric-card">
        <div>
          <div class="metric-title">Total de Registros</div>
          <div class="metric-value"><?php echo $totalGeral; ?></div>
        </div>
        <div class="metric-icon icon-navy">
          <i class="fa-solid fa-users"></i>
        </div>
      </div>

      <div class="metric-card">
        <div>
          <div class="metric-title">Vagas Confirmadas</div>
          <div class="metric-value" style="color: #0E9F6E;"><?php echo $totalConfirmados; ?></div>
        </div>
        <div class="metric-icon icon-green">
          <i class="fa-solid fa-user-check"></i>
        </div>
      </div>

      <div class="metric-card">
        <div>
          <div class="metric-title">Vagas Restantes no Evento Ativo</div>
          <div class="metric-value" style="color: var(--color-primary-red);"><?php echo $vagasRestantesMain; ?></div>
        </div>
        <div class="metric-icon icon-red">
          <i class="fa-solid fa-ticket"></i>
        </div>
      </div>
    </div>

    <!-- Toolbar: Search, Filters & Create Button -->
    <div class="toolbar-box">
      <form method="GET" action="index.php" class="search-form">
        <input type="text" name="search" class="form-input" placeholder="Buscar por Nome ou WhatsApp..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 2;">
        
        <select name="evento_filter" class="form-input" style="flex: 1.5;" onchange="this.form.submit()">
          <option value="0">Todos os Simpósios</option>
          <?php foreach ($todosEventos as $ev) { ?>
            <option value="<?php echo $ev['id']; ?>" <?php echo $filterEvento == $ev['id'] ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($ev['titulo']); ?> (<?php echo date('d/m/Y', strtotime($ev['data_evento'])); ?>)
            </option>
          <?php } ?>
        </select>

        <select name="status_filter" class="form-input" style="flex: 1;" onchange="this.form.submit()">
          <option value="">Todos Status</option>
          <option value="confirmado" <?php echo $filterStatus === 'confirmado' ? 'selected' : ''; ?>>Confirmados</option>
          <option value="pendente" <?php echo $filterStatus === 'pendente' ? 'selected' : ''; ?>>Pendentes</option>
          <option value="cancelado" <?php echo $filterStatus === 'cancelado' ? 'selected' : ''; ?>>Cancelados</option>
        </select>
        <button type="submit" class="btn-action btn-navy"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

      <button class="btn-action btn-red" onclick="openCreateModal()">
        <i class="fa-solid fa-plus-circle"></i> NOVO INSCRITO
      </button>
    </div>

    <!-- Subscribers Table -->
    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>SIMPÓSIO / EVENTO</th>
            <th>NOME DO PARTICIPANTE</th>
            <th>TELEFONE WHATSAPP</th>
            <th>STATUS</th>
            <th>DATA DA INSCRIÇÃO</th>
            <th style="text-align: right;">AÇÕES</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($inscritos) > 0) { ?>
            <?php foreach ($inscritos as $item) { ?>
              <tr>
                <td><strong>#<?php echo $item['id']; ?></strong></td>
                <td>
                  <span style="font-size: 0.85rem; font-weight: 700; color: #475569;">
                    <i class="fa-solid fa-calendar-day" style="color: var(--color-primary-red);"></i> <?php echo htmlspecialchars($item['evento_titulo'] ?? 'Simpósio'); ?>
                  </span>
                </td>
                <td>
                  <strong style="color: var(--color-navy-dark);"><?php echo htmlspecialchars($item['nome']); ?></strong>
                </td>
                <td>
                  <a href="https://wa.me/55<?php echo preg_replace('/\D/', '', $item['whatsapp']); ?>" target="_blank" style="color: #059669; font-weight: 600; text-decoration: none;">
                    <i class="fa-brands fa-whatsapp"></i> <?php echo htmlspecialchars($item['whatsapp']); ?>
                  </a>
                </td>
                <td>
                  <span class="badge badge-<?php echo $item['status']; ?>">
                    <?php echo ucfirst($item['status']); ?>
                  </span>
                </td>
                <td style="color: #64748B; font-size: 0.85rem;">
                  <?php echo date('d/m/Y H:i', strtotime($item['created_at'])); ?>
                </td>
                <td style="text-align: right;">
                  <button class="btn-sm-edit" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                    <i class="fa-solid fa-pen"></i> Editar
                  </button>
                  <form method="POST" action="index.php" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta inscrição?');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="btn-sm-delete">
                      <i class="fa-solid fa-trash"></i> Excluir
                    </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="7" style="text-align: center; padding: 40px; color: #94A3B8;">
                <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 10px; display: block;"></i>
                Nenhum inscrito encontrado.
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

  <!-- Create Modal -->
  <div class="modal-overlay" id="createModal">
    <div class="modal-content">
      <div class="modal-top">
        <h3>Nova Inscrição</h3>
        <button class="close-modal-btn" onclick="closeCreateModal()">&times;</button>
      </div>
      <form method="POST" action="index.php" class="modal-body-form">
        <input type="hidden" name="action" value="create">
        
        <div class="form-group-modal">
          <label>Selecione o Simpósio *</label>
          <select name="simposio_id" class="form-input" required>
            <?php foreach ($todosEventos as $ev) { ?>
              <option value="<?php echo $ev['id']; ?>"><?php echo htmlspecialchars($ev['titulo']); ?> (<?php echo date('d/m/Y', strtotime($ev['data_evento'])); ?>)</option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group-modal">
          <label>Nome Completo *</label>
          <input type="text" name="nome" class="form-input" placeholder="Ex: Dr. João da Silva" required>
        </div>

        <div class="form-group-modal">
          <label>Telefone WhatsApp *</label>
          <input type="text" name="whatsapp" id="createWhatsapp" class="form-input" placeholder="(21) 99999-9999" required>
        </div>

        <div class="form-group-modal">
          <label>Status da Vaga</label>
          <select name="status" class="form-input">
            <option value="confirmado">Confirmado</option>
            <option value="pendente">Pendente</option>
            <option value="cancelado">Cancelado</option>
          </select>
        </div>

        <button type="submit" class="btn-action btn-red" style="width: 100%; justify-content: center; padding: 14px; font-size: 0.95rem;">
          <i class="fa-solid fa-check-circle"></i> SALVAR INSCRIÇÃO
        </button>
      </form>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal-overlay" id="editModal">
    <div class="modal-content">
      <div class="modal-top">
        <h3>Editar Inscrição</h3>
        <button class="close-modal-btn" onclick="closeEditModal()">&times;</button>
      </div>
      <form method="POST" action="index.php" class="modal-body-form">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" id="editId">
        
        <div class="form-group-modal">
          <label>Simpósio *</label>
          <select name="simposio_id" id="editSimposioId" class="form-input" required>
            <?php foreach ($todosEventos as $ev) { ?>
              <option value="<?php echo $ev['id']; ?>"><?php echo htmlspecialchars($ev['titulo']); ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group-modal">
          <label>Nome Completo *</label>
          <input type="text" name="nome" id="editNome" class="form-input" required>
        </div>

        <div class="form-group-modal">
          <label>Telefone WhatsApp *</label>
          <input type="text" name="whatsapp" id="editWhatsapp" class="form-input" required>
        </div>

        <div class="form-group-modal">
          <label>Status da Vaga</label>
          <select name="status" id="editStatus" class="form-input">
            <option value="confirmado">Confirmado</option>
            <option value="pendente">Pendente</option>
            <option value="cancelado">Cancelado</option>
          </select>
        </div>

        <button type="submit" class="btn-action btn-navy" style="width: 100%; justify-content: center; padding: 14px; font-size: 0.95rem;">
          <i class="fa-solid fa-floppy-disk"></i> ATUALIZAR REGISTRO
        </button>
      </form>
    </div>
  </div>

  <script>
    function openCreateModal() {
      document.getElementById('createModal').classList.add('active');
    }
    function closeCreateModal() {
      document.getElementById('createModal').classList.remove('active');
    }

    function openEditModal(item) {
      document.getElementById('editId').value = item.id;
      document.getElementById('editSimposioId').value = item.simposio_id;
      document.getElementById('editNome').value = item.nome;
      document.getElementById('editWhatsapp').value = item.whatsapp;
      document.getElementById('editStatus').value = item.status;
      document.getElementById('editModal').classList.add('active');
    }
    function closeEditModal() {
      document.getElementById('editModal').classList.remove('active');
    }

    // Phone Mask
    function applyMask(el) {
      el.addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length > 11) v = v.slice(0, 11);
        if (v.length > 10) v = v.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        else if (v.length > 6) v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
        else if (v.length > 2) v = v.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
        else if (v.length > 0) v = v.replace(/^(\d*)$/, '($1');
        e.target.value = v;
      });
    }

    const cPhone = document.getElementById('createWhatsapp');
    const ePhone = document.getElementById('editWhatsapp');
    if (cPhone) applyMask(cPhone);
    if (ePhone) applyMask(ePhone);
  </script>

</body>
</html>
