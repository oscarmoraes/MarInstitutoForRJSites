<?php
session_start();
require_once __DIR__.'/../db.php';

// Se já estiver logado, redireciona para o painel
if (isset($_SESSION['simposio_admin_logged']) && $_SESSION['simposio_admin_logged'] === true) {
    header('Location: index.php');
    exit;
}

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (! empty($usuario) && ! empty($senha)) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM `simposio_usuarios` WHERE `usuario` = :u LIMIT 1');
            $stmt->execute([':u' => $usuario]);
            $user = $stmt->fetch();

            if ($user) {
                $hashBanco = $user['senha'];
                $isPasswordValid = false;

                // 1. Verifica no padrão PHP password_hash (BCRYPT $2y$...)
                if (password_verify($senha, $hashBanco)) {
                    $isPasswordValid = true;
                }
                // 2. Compatibilidade com senhas alteradas via MD5 no phpMyAdmin
                elseif (md5($senha) === strtolower($hashBanco) || md5($senha) === $hashBanco) {
                    $isPasswordValid = true;
                    // Atualiza no banco para BCRYPT seguro automaticamente
                    $newBcrypt = password_hash($senha, PASSWORD_DEFAULT);
                    $stmtUpgrade = $pdo->prepare('UPDATE `simposio_usuarios` SET `senha` = :newpass WHERE `id` = :id');
                    $stmtUpgrade->execute([':newpass' => $newBcrypt, ':id' => $user['id']]);
                }
                // 3. Compatibilidade com texto puro
                elseif ($senha === $hashBanco) {
                    $isPasswordValid = true;
                    $newBcrypt = password_hash($senha, PASSWORD_DEFAULT);
                    $stmtUpgrade = $pdo->prepare('UPDATE `simposio_usuarios` SET `senha` = :newpass WHERE `id` = :id');
                    $stmtUpgrade->execute([':newpass' => $newBcrypt, ':id' => $user['id']]);
                }

                if ($isPasswordValid) {
                    $_SESSION['simposio_admin_logged'] = true;
                    $_SESSION['simposio_admin_name'] = $user['nome'];
                    $_SESSION['simposio_admin_user'] = $user['usuario'];
                    header('Location: index.php');
                    exit;
                } else {
                    $errorMsg = 'Usuário ou senha incorretos.';
                }
            } else {
                $errorMsg = 'Usuário não encontrado.';
            }
        } catch (Exception $e) {
            $errorMsg = 'Erro ao verificar credenciais: '.$e->getMessage();
        }
    } else {
        $errorMsg = 'Preencha todos os campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrativo - Simpósio | Instituto MAR</title>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts: Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --color-primary-red: #B81D24;
      --color-navy-dark: #0D1B2A;
      --color-navy-medium: #14213D;
      --color-white: #FFFFFF;
      --font-family: 'Montserrat', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: var(--font-family);
      background: linear-gradient(135deg, var(--color-navy-dark) 0%, var(--color-navy-medium) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: var(--color-white);
      border-radius: 16px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
      overflow: hidden;
    }

    .login-header {
      background: var(--color-navy-dark);
      color: var(--color-white);
      padding: 30px 25px;
      text-align: center;
      border-bottom: 4px solid var(--color-primary-red);
    }

    .login-brand-icon {
      font-size: 2.5rem;
      color: var(--color-primary-red);
      margin-bottom: 10px;
    }

    .login-header h2 {
      font-size: 1.25rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .login-header p {
      font-size: 0.8rem;
      color: #CBD5E1;
      margin-top: 5px;
    }

    .login-body {
      padding: 30px;
    }

    .alert-error {
      background: #FDE8E8;
      color: #9B1C1C;
      border: 1px solid #F8B4B4;
      padding: 12px 15px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 0.8rem;
      font-weight: 700;
      text-transform: uppercase;
      color: var(--color-navy-dark);
      margin-bottom: 8px;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94A3B8;
    }

    .form-input {
      width: 100%;
      padding: 14px 14px 14px 42px;
      border: 1.5px solid #E2E8F0;
      border-radius: 8px;
      font-size: 0.95rem;
      font-family: inherit;
      outline: none;
      transition: all 0.2s;
    }

    .form-input:focus {
      border-color: var(--color-primary-red);
      box-shadow: 0 0 0 3px rgba(184, 29, 36, 0.15);
    }

    .btn-login {
      width: 100%;
      background: var(--color-primary-red);
      color: var(--color-white);
      border: none;
      padding: 16px;
      font-size: 0.95rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-login:hover {
      background: #9E171D;
    }

    .login-footer {
      text-align: center;
      padding-top: 15px;
      font-size: 0.8rem;
      color: #64748B;
    }

    .login-footer a {
      color: var(--color-primary-red);
      text-decoration: none;
      font-weight: 700;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="login-header">
      <i class="fa-solid fa-lock login-brand-icon"></i>
      <h2>ÁREA RESTRITA</h2>
      <p>Acesso ao Painel de Inscritos do Simpósio</p>
    </div>

    <div class="login-body">
      <?php if (! empty($errorMsg)) { ?>
        <div class="alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span><?php echo htmlspecialchars($errorMsg); ?></span>
        </div>
      <?php } ?>

      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="usuario">Usuário</label>
          <div class="input-wrap">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="usuario" name="usuario" class="form-input" placeholder="Digite seu usuário" required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label for="senha">Senha</label>
          <div class="input-wrap">
            <i class="fa-solid fa-key"></i>
            <input type="password" id="senha" name="senha" class="form-input" placeholder="Digite sua senha" required>
          </div>
        </div>

        <button type="submit" class="btn-login">
          <i class="fa-solid fa-right-to-bracket"></i> ENTRAR NO PAINEL
        </button>
      </form>

      <div class="login-footer">
        <p><a href="../"><i class="fa-solid fa-arrow-left"></i> Voltar ao site do Simpósio</a></p>
      </div>
    </div>
  </div>

</body>
</html>
