-- Script de Criação do Banco de Dados com Gerenciamento de Múltiplos Simpósios
-- Instituto MAR (Movimento da Advocacia Renovada)

CREATE DATABASE IF NOT EXISTS `mar_rjsites` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mar_rjsites`;

-- Tabela de Eventos / Simpósios
CREATE TABLE IF NOT EXISTS `simposio_eventos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `titulo` VARCHAR(255) NOT NULL,
  `data_evento` DATETIME NOT NULL,
  `vagas_totais` INT NOT NULL DEFAULT 30,
  `ativo` TINYINT(1) DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir Simpósio Padrão caso não exista
INSERT INTO `simposio_eventos` (`slug`, `titulo`, `data_evento`, `vagas_totais`, `ativo`)
SELECT 'simposio-2026', 'Simpósio Instituto MAR', '2026-11-11 09:00:00', 30, 1
WHERE NOT EXISTS (SELECT 1 FROM `simposio_eventos` WHERE `slug` = 'simposio-2026');

-- Tabela de Inscritos no Simpósio
CREATE TABLE IF NOT EXISTS `simposio_inscritos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `simposio_id` INT NOT NULL DEFAULT 1,
  `nome` VARCHAR(255) NOT NULL,
  `whatsapp` VARCHAR(30) NOT NULL,
  `status` ENUM('confirmado', 'pendente', 'cancelado') DEFAULT 'confirmado',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`simposio_id`) REFERENCES `simposio_eventos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Usuários Administradores para Proteção por Senha
CREATE TABLE IF NOT EXISTS `simposio_usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario` VARCHAR(100) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir Usuário Administrador Padrão (Login: admin | Senha: admin123)
INSERT INTO `simposio_usuarios` (`usuario`, `senha`, `nome`)
SELECT 'admin', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe1aKx8F6V6gG1O6N3w4o1rP0u9nJ1Kvy', 'Administrador MAR'
WHERE NOT EXISTS (SELECT 1 FROM `simposio_usuarios` WHERE `usuario` = 'admin');
