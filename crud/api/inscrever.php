<?php

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);

$nome = trim($inputData['nome'] ?? $_POST['nome'] ?? '');
$whatsapp = trim($inputData['whatsapp'] ?? $_POST['whatsapp'] ?? '');
$simposioId = (int) ($inputData['simposio_id'] ?? $_POST['simposio_id'] ?? 1);

// Buscar detalhes do simpósio
$stmtEvent = $pdo->prepare('SELECT * FROM `simposio_eventos` WHERE `id` = :id LIMIT 1');
$stmtEvent->execute([':id' => $simposioId]);
$event = $stmtEvent->fetch();

if (! $event) {
    // Fallback para o primeiro evento ativo
    $stmtEvent = $pdo->query('SELECT * FROM `simposio_eventos` WHERE `ativo` = 1 ORDER BY `id` ASC LIMIT 1');
    $event = $stmtEvent->fetch();
    $simposioId = $event ? (int) $event['id'] : 1;
}

// Validação dos Campos
if (empty($nome) || strlen($nome) < 3) {
    echo json_encode(['success' => false, 'message' => 'Por favor, informe seu nome completo (mínimo 3 caracteres).']);
    exit;
}

$digitsPhone = preg_replace('/\D/', '', $whatsapp);
if (empty($whatsapp) || strlen($digitsPhone) < 10) {
    echo json_encode(['success' => false, 'message' => 'Por favor, informe um número de WhatsApp válido com DDD.']);
    exit;
}

try {
    // Verificar se já existe inscrição com este WhatsApp para ESTE simpósio
    $stmtCheck = $pdo->prepare('SELECT id, status FROM `simposio_inscritos` WHERE `whatsapp` = :whatsapp AND `simposio_id` = :sid LIMIT 1');
    $stmtCheck->execute([':whatsapp' => $whatsapp, ':sid' => $simposioId]);
    $existing = $stmtCheck->fetch();

    if ($existing) {
        echo json_encode([
            'success' => true,
            'already_registered' => true,
            'id' => $existing['id'],
            'nome' => $nome,
            'message' => 'Este número de WhatsApp já possui uma inscrição garantida para este simpósio!',
        ]);
        exit;
    }

    // Inserir nova inscrição no Banco de Dados
    $stmtInsert = $pdo->prepare("INSERT INTO `simposio_inscritos` (`simposio_id`, `nome`, `whatsapp`, `status`, `created_at`) VALUES (:sid, :nome, :whatsapp, 'confirmado', NOW())");
    $stmtInsert->execute([
        ':sid' => $simposioId,
        ':nome' => $nome,
        ':whatsapp' => $whatsapp,
    ]);

    $newId = $pdo->lastInsertId();

    // Buscar total de inscritos atualizados para este simpósio
    $stmtCount = $pdo->prepare("SELECT COUNT(*) as total FROM `simposio_inscritos` WHERE `simposio_id` = :sid AND `status` = 'confirmado'");
    $stmtCount->execute([':sid' => $simposioId]);
    $totalInscritos = $stmtCount->fetch()['total'];

    $vagasTotais = $event ? (int) $event['vagas_totais'] : 30;

    echo json_encode([
        'success' => true,
        'id' => $newId,
        'nome' => $nome,
        'whatsapp' => $whatsapp,
        'total_inscritos' => (int) $totalInscritos,
        'vagas_totais' => $vagasTotais,
        'vagas_restantes' => max(0, $vagasTotais - (int) $totalInscritos),
        'message' => 'Inscrição realizada com sucesso!',
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao salvar no banco de dados: '.$e->getMessage(),
    ]);
}
