<?php

/**
 * Conexão com o Banco de Dados MySQL
 * Suporte a Hostinger (oscarlima.com.br/simposio) com fallback de usuários
 */
$is_local = (in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']) || ($_SERVER['HTTP_HOST'] ?? '') === 'localhost');

if ($is_local) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'mar_rjsites';
} else {
    $host = 'localhost';
    $pass = 'dI:FNeE~9xM;';

    // Lista de combinações possíveis para usuário e banco na Hostinger
    $possible_credentials = [
        ['user' => 'u200398770_simposio', 'db' => 'u200398770_simposio'],
        ['user' => 'u200398770_simposio', 'db' => 'u200398770_mar'],
        ['user' => 'u200398770_mar',       'db' => 'u200398770_mar'],
        ['user' => 'u200398770_mar',       'db' => 'u200398770_simposio'],
    ];

    $pdo = null;
    $last_error = null;

    foreach ($possible_credentials as $cred) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname={$cred['db']};charset=utf8mb4", $cred['user'], $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $user = $cred['user'];
            $dbname = $cred['db'];
            break; // Conexão bem-sucedida!
        } catch (PDOException $e) {
            $last_error = $e;
        }
    }

    if (! $pdo) {
        http_response_code(500);
        exit(json_encode([
            'success' => false,
            'message' => 'Erro de Conexão com o Banco de Dados: '.($last_error ? $last_error->getMessage() : 'Acesso negado'),
            'tip' => 'Verifique no hPanel da Hostinger se o usuário MySQL tem permissão atribuída ao banco de dados.',
        ]));
    }
}

// ----------------------------------------------------------------------
// Inicialização Automática das Tabelas se Conectado com Sucesso
// ----------------------------------------------------------------------
try {
    // 1. Tabela de Eventos / Simpósios
    $pdo->exec('
    CREATE TABLE IF NOT EXISTS `simposio_eventos` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `slug` VARCHAR(100) NOT NULL UNIQUE,
      `titulo` VARCHAR(255) NOT NULL,
      `data_evento` DATETIME NOT NULL,
      `vagas_totais` INT NOT NULL DEFAULT 30,
      `ativo` TINYINT(1) DEFAULT 1,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

    $stmtEvCheck = $pdo->query('SELECT COUNT(*) as total FROM `simposio_eventos`');
    if ($stmtEvCheck->fetch()['total'] == 0) {
        $pdo->exec("INSERT INTO `simposio_eventos` (`slug`, `titulo`, `data_evento`, `vagas_totais`, `ativo`) VALUES ('simposio-2026', 'Simpósio Instituto MAR', '2026-11-11 09:00:00', 30, 1)");
    }

    // 2. Tabela de Inscritos
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `simposio_inscritos` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `simposio_id` INT NOT NULL DEFAULT 1,
      `nome` VARCHAR(255) NOT NULL,
      `whatsapp` VARCHAR(30) NOT NULL,
      `status` ENUM('confirmado', 'pendente', 'cancelado') DEFAULT 'confirmado',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 3. Tabela de Usuários Admin (Sem senhas padrão fixas no arquivo)
    $pdo->exec('
    CREATE TABLE IF NOT EXISTS `simposio_usuarios` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `usuario` VARCHAR(100) NOT NULL UNIQUE,
      `senha` VARCHAR(255) NOT NULL,
      `nome` VARCHAR(100) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

} catch (PDOException $e) {
    // Silently continue if tables already exist
}
