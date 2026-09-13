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
// Processamento do CRUD de Eventos (POST Actions)
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // CREATE EVENT
    if ($action === 'create_event') {
        $titulo = trim($_POST['titulo'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $dataEvento = $_POST['data_evento'] ?? '';
        $vagasTotais = (int) ($_POST['vagas_totais'] ?? 30);
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        if (empty($slug)) {
            // Gerar slug a partir do título
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $titulo)));
        }

        if (! empty($titulo) && ! empty($dataEvento) && $vagasTotais > 0) {
            try {
                $stmt = $pdo->prepare('INSERT INTO `simposio_eventos` (`titulo`, `slug`, `data_evento`, `vagas_totais`, `ativo`, `created_at`) VALUES (:t, :s, :d, :v, :a, NOW())');
                $stmt->execute([
                    ':t' => $titulo,
                    ':s' => $slug,
                    ':d' => $dataEvento,
                    ':v' => $vagasTotais,
                    ':a' => $ativo,
                ]);
                $message = 'Novo Simpósio cadastrado com sucesso!';
                $messageType = 'success';
            } catch (PDOException $e) {
                $message = 'Erro ao salvar simpósio: '.$e->getMessage();
                $messageType = 'danger';
            }
        } else {
            $message = 'Preencha todos os campos obrigatórios.';
            $messageType = 'warning';
        }
    }

    // UPDATE EVENT
    if ($action === 'update_event') {
        $id = (int) ($_POST['id'] ?? 0);
        $titulo = trim($_POST['titulo'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $dataEvento = $_POST['data_evento'] ?? '';
        $vagasTotais = (int) ($_POST['vagas_totais'] ?? 30);
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        if ($id > 0 && ! empty($titulo) && ! empty($dataEvento)) {
            try {
                $stmt = $pdo->prepare('UPDATE `simposio_eventos` SET `titulo` = :t, `slug` = :s, `data_evento` = :d, `vagas_totais` = :v, `ativo` = :a WHERE `id` = :id');
                $stmt->execute([
                    ':id' => $id,
                    ':t' => $titulo,
                    ':s' => $slug,
                    ':d' => $dataEvento,
                    ':v' => $vagasTotais,
                    ':a' => $ativo,
                ]);
                $message = 'Simpósio atualizado com sucesso!';
                $messageType = 'success';
            } catch (PDOException $e) {
                $message = 'Erro ao atualizar simpósio: '.$e->getMessage();
                $messageType = 'danger';
            }
        }
    }

    // DELETE EVENT
    if ($action === 'delete_event') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            try {
                $stmt = $pdo->prepare('DELETE FROM `simposio_eventos` WHERE `id` = :id');
                $stmt->execute([':id' => $id]);
                $message = 'Simpósio excluído com sucesso.';
                $messageType = 'info';
            } catch (PDOException $e) {
                $message = 'Erro ao deletar simpósio: '.$e->getMessage();
                $messageType = 'danger';
            }
        }
    }
}

// ----------------------------------------------------------------------
// READ EVENTOS
// ----------------------------------------------------------------------
$stmtEvents = $pdo->query("
    SELECT e.*, COUNT(i.id) as total_inscritos 
    FROM `simposio_eventos` e 
    LEFT JOIN `simposio_inscritos` i ON e.id = i.simposio_id AND i.status = 'confirmado'
    GROUP BY e.id 
    ORDER BY e.id DESC
");
$eventos = $stmtEvents->fetchAll();

$adminName = $_SESSION['simposio_admin_name'] ?? 'Administrador';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar Simpósios - Painel Admin | Instituto MAR</title>
  
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
    .admin-brand h1 { font-size: 1.25rem; font-weight: 800; text-transform: uppercase; }

    .header-actions { display: flex; align-items: center; gap: 15px; }

    .btn-nav-tab {
      background: rgba(255,255,255,0.1);
      color: white;
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      transition: all 0.2s;
    }
    .btn-nav-tab.active { background: var(--color-primary-red); }
    .btn-nav-tab:hover { background: var(--color-primary-red); }

    .btn-logout { background: #DC2626; color: white; padding: 8px 16px; border-radius: 6px; font-size: 0.85rem; font-weight: 700; text-decoration: none; }

    .admin-container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

    .alert { padding: 14px 20px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; }
    .alert-success { background: #DEF7EC; color: #03543F; border: 1px solid #84E1BC; }
    .alert-danger { background: #FDE8E8; color: #9B1C1C; border: 1px solid #F8B4B4; }
    .alert-warning { background: #FEF08A; color: #713F12; border: 1px solid #FDE047; }
    .alert-info { background: #E1F5FE; color: #0277BD; border: 1px solid #81D4FA; }

    .toolbar-box {
      background: var(--color-white);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid var(--color-border);
      margin-bottom: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-action {
      padding: 10px 18px; border-radius: 6px; font-size: 0.85rem; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
    }
    .btn-red { background: var(--color-primary-red); color: white; }
    .btn-navy { background: var(--color-navy-dark); color: white; }

    .table-card { background: var(--color-white); border-radius: 12px; border: 1px solid var(--color-border); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }

    table { width: 100%; border-collapse: collapse; text-align: left; }
    th { background: #F1F5F9; padding: 14px 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #475569; border-bottom: 1px solid var(--color-border); }
    td { padding: 16px 20px; font-size: 0.9rem; border-bottom: 1px solid var(--color-border); vertical-align: middle; }

    .badge { display: inline-block; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .badge-ativo { background: #DEF7EC; color: #03543F; }
    .badge-inativo { background: #FDE8E8; color: #9B1C1C; }

    .btn-sm-edit { background: #E2E8F0; color: #334155; padding: 6px 12px; border-radius: 4px; font-size: 0.78rem; font-weight: 700; cursor: pointer; border: none; margin-right: 5px; }
    .btn-sm-delete { background: #FDE8E8; color: #9B1C1C; padding: 6px 12px; border-radius: 4px; font-size: 0.78rem; font-weight: 700; cursor: pointer; border: none; }

    .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(13, 27, 42, 0.75); backdrop-filter: blur(4px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px; }
    .modal-overlay.active { display: flex; }
    .modal-content { background: white; border-radius: 12px; max-width: 500px; width: 100%; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3); }
    .modal-top { background: var(--color-navy-dark); color: white; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid var(--color-primary-red); }
    .modal-top h3 { font-size: 1.1rem; font-weight: 800; text-transform: uppercase; }
    .close-modal-btn { background: none; border: none; color: white; font-size: 1.4rem; cursor: pointer; }
    .modal-body-form { padding: 25px; }

    .form-group-modal { margin-bottom: 18px; }
    .form-group-modal label { display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #475569; }
    .form-input { width: 100%; padding: 10px 14px; border: 1.5px solid var(--color-border); border-radius: 6px; font-size: 0.9rem; font-family: inherit; outline: none; }
  </style>
</head>
<body>

  <header class="admin-header">
    <a href="index.php" class="admin-brand">
      <i class="fa-solid fa-scale-balanced"></i>
      <div>
        <h1>PAINEL DE SIMPÓSIOS</h1>
        <span style="font-size: 0.7rem; opacity: 0.8; font-weight: 500;">Gerenciar Eventos, Datas e Limite de Vagas</span>
      </div>
    </a>
    <div class="header-actions">
      <a href="index.php" class="btn-nav-tab"><i class="fa-solid fa-users"></i> INSCRITOS</a>
      <a href="eventos.php" class="btn-nav-tab active"><i class="fa-solid fa-calendar-days"></i> SIMPÓSIOS</a>
      <a href="../" class="btn-nav-tab" target="_blank"><i class="fa-solid fa-globe"></i> SITE</a>
      <a href="logout.php" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> SAIR</a>
    </div>
  </header>

  <div class="admin-container">

    <?php if (! empty($message)) { ?>
      <div class="alert alert-<?php echo $messageType; ?>">
        <i class="fa-solid fa-info-circle"></i>
        <span><?php echo htmlspecialchars($message); ?></span>
      </div>
    <?php } ?>

    <div class="toolbar-box">
      <div>
        <h2 style="font-size: 1.2rem; font-weight: 800; color: var(--color-navy-dark);">Simpósios Cadastrados</h2>
        <p style="font-size: 0.85rem; color: #64748B;">Crie novos eventos, defina a data/hora e edite o número de vagas limitadas.</p>
      </div>

      <button class="btn-action btn-red" onclick="openCreateEventModal()">
        <i class="fa-solid fa-plus-circle"></i> CRIAR NOVO SIMPÓSIO
      </button>
    </div>

    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>TÍTULO DO SIMPÓSIO</th>
            <th>DATA DO EVENTO</th>
            <th>VAGAS TOTAL / INSCRITOS</th>
            <th>SLUG / LINK PÚBLICO</th>
            <th>STATUS</th>
            <th style="text-align: right;">AÇÕES</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($eventos) > 0) { ?>
            <?php foreach ($eventos as $ev) { ?>
              <tr>
                <td><strong>#<?php echo $ev['id']; ?></strong></td>
                <td>
                  <strong style="color: var(--color-navy-dark); font-size: 1rem;"><?php echo htmlspecialchars($ev['titulo']); ?></strong>
                </td>
                <td>
                  <i class="fa-solid fa-calendar-day" style="color: var(--color-primary-red); margin-right: 5px;"></i>
                  <strong><?php echo date('d/m/Y H:i', strtotime($ev['data_evento'])); ?></strong>
                </td>
                <td>
                  <strong style="color: #0E9F6E;"><?php echo $ev['total_inscritos']; ?></strong> / <strong><?php echo $ev['vagas_totais']; ?> Vagas</strong>
                </td>
                <td>
                  <a href="../index.php?slug=<?php echo htmlspecialchars($ev['slug']); ?>" target="_blank" style="color: #2563EB; font-weight: 600; font-size: 0.85rem; text-decoration: none;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> ?slug=<?php echo htmlspecialchars($ev['slug']); ?>
                  </a>
                </td>
                <td>
                  <span class="badge badge-<?php echo $ev['ativo'] ? 'ativo' : 'inativo'; ?>">
                    <?php echo $ev['ativo'] ? 'Ativo' : 'Inativo'; ?>
                  </span>
                </td>
                <td style="text-align: right;">
                  <button class="btn-sm-edit" onclick="openEditEventModal(<?php echo htmlspecialchars(json_encode($ev)); ?>)">
                    <i class="fa-solid fa-pen"></i> Editar
                  </button>
                  <form method="POST" action="eventos.php" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este simpósio?');">
                    <input type="hidden" name="action" value="delete_event">
                    <input type="hidden" name="id" value="<?php echo $ev['id']; ?>">
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
                Nenhum simpósio cadastrado.
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

  <!-- Modal Criar Evento -->
  <div class="modal-overlay" id="createEventModal">
    <div class="modal-content">
      <div class="modal-top">
        <h3>Criar Novo Simpósio</h3>
        <button class="close-modal-btn" onclick="closeCreateEventModal()">&times;</button>
      </div>
      <form method="POST" action="eventos.php" class="modal-body-form">
        <input type="hidden" name="action" value="create_event">
        
        <div class="form-group-modal">
          <label>Título do Simpósio *</label>
          <input type="text" name="titulo" class="form-input" placeholder="Ex: I Simpósio de Advocacia Trabalhista" required>
        </div>

        <div class="form-group-modal">
          <label>Identificador URL (Slug)</label>
          <input type="text" name="slug" class="form-input" placeholder="Ex: simposio-sp-2026 (deixe em branco para automático)">
        </div>

        <div class="form-group-modal">
          <label>Data e Hora do Evento *</label>
          <input type="datetime-local" name="data_evento" class="form-input" value="2026-11-11T09:00" required>
        </div>

        <div class="form-group-modal">
          <label>Quantidade de Vagas Limitadas *</label>
          <input type="number" name="vagas_totais" class="form-input" value="30" min="1" required>
        </div>

        <div class="form-group-modal" style="display: flex; align-items: center; gap: 10px;">
          <input type="checkbox" name="ativo" id="createAtivo" value="1" checked style="width: 18px; height: 18px;">
          <label for="createAtivo" style="margin: 0; cursor: pointer;">Simpósio Ativo</label>
        </div>

        <button type="submit" class="btn-action btn-red" style="width: 100%; justify-content: center; padding: 14px; font-size: 0.95rem;">
          <i class="fa-solid fa-plus-circle"></i> CADASTRAR SIMPÓSIO
        </button>
      </form>
    </div>
  </div>

  <!-- Modal Editar Evento -->
  <div class="modal-overlay" id="editEventModal">
    <div class="modal-content">
      <div class="modal-top">
        <h3>Editar Simpósio</h3>
        <button class="close-modal-btn" onclick="closeEditEventModal()">&times;</button>
      </div>
      <form method="POST" action="eventos.php" class="modal-body-form">
        <input type="hidden" name="action" value="update_event">
        <input type="hidden" name="id" id="editEventId">
        
        <div class="form-group-modal">
          <label>Título do Simpósio *</label>
          <input type="text" name="titulo" id="editEventTitulo" class="form-input" required>
        </div>

        <div class="form-group-modal">
          <label>Identificador URL (Slug) *</label>
          <input type="text" name="slug" id="editEventSlug" class="form-input" required>
        </div>

        <div class="form-group-modal">
          <label>Data e Hora do Evento *</label>
          <input type="datetime-local" name="data_evento" id="editEventData" class="form-input" required>
        </div>

        <div class="form-group-modal">
          <label>Quantidade de Vagas Limitadas *</label>
          <input type="number" name="vagas_totais" id="editEventVagas" class="form-input" min="1" required>
        </div>

        <div class="form-group-modal" style="display: flex; align-items: center; gap: 10px;">
          <input type="checkbox" name="ativo" id="editEventAtivo" value="1" style="width: 18px; height: 18px;">
          <label for="editEventAtivo" style="margin: 0; cursor: pointer;">Simpósio Ativo</label>
        </div>

        <button type="submit" class="btn-action btn-navy" style="width: 100%; justify-content: center; padding: 14px; font-size: 0.95rem;">
          <i class="fa-solid fa-floppy-disk"></i> ATUALIZAR SIMPÓSIO
        </button>
      </form>
    </div>
  </div>

  <script>
    function openCreateEventModal() {
      document.getElementById('createEventModal').classList.add('active');
    }
    function closeCreateEventModal() {
      document.getElementById('createEventModal').classList.remove('active');
    }

    function openEditEventModal(ev) {
      document.getElementById('editEventId').value = ev.id;
      document.getElementById('editEventTitulo').value = ev.titulo;
      document.getElementById('editEventSlug').value = ev.slug;
      
      // Formata data YYYY-MM-DD HH:II para datetime-local YYYY-MM-DDTHH:II
      let dStr = ev.data_evento.replace(' ', 'T').slice(0, 16);
      document.getElementById('editEventData').value = dStr;
      
      document.getElementById('editEventVagas').value = ev.vagas_totais;
      document.getElementById('editEventAtivo').checked = (parseInt(ev.ativo) === 1);

      document.getElementById('editEventModal').classList.add('active');
    }
    function closeEditEventModal() {
      document.getElementById('editEventModal').classList.remove('active');
    }
  </script>

</body>
</html>
