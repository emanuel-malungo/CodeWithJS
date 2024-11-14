<?php
include('./includes/db.php'); // Conexão ao banco de dados
include('./includes/functions.php'); // Arquivo para as funções

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_acesso = $_POST['tipo_acesso'];
    $status = $_POST['status'];

    // Verifica se o e-mail já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error = "E-mail já está em uso!";
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_acesso, status) VALUES (:nome, :email, :senha, :tipo_acesso, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha); // Usando senha em texto simples
        $stmt->bindParam(':tipo_acesso', $tipo_acesso);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            header("Location: login.php?success=1"); // Redireciona para login após registro
            exit();
        } else {
            $error = "Erro ao registrar o usuário. Tente novamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ===================== CSS ===================== -->
    <link rel="stylesheet" href="./assets/css/register.css">
    <!-- ===================== REMIXICON ===================== -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Registro - EF-Security</title>
</head>
<body>
    <div class="register-container">
        <form action="" method="POST" class="register-form" id="register-form">
            <div class="register-header">
                <i class="ri-secure-payment-line logo"></i>
                <p class="logo-text">EF-SECURITY</p>
                <h1 class="register-title">Criar Conta</h1>
                <p class="register-subtitle">Registre-se para começar a usar nosso sistema.</p>
            </div>
            <div class="register-inputs">
                <!-- Input de Nome -->
                <div class="input-group">
                    <i class="ri-user-3-line"></i>
                    <input type="text" name="nome" placeholder="Digite seu nome" required>
                </div>
                <!-- Input de E-mail -->
                <div class="input-group">
                    <i class="ri-mail-line"></i>
                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                <!-- Input de Senha -->
                <div class="input-group">
                    <i class="ri-lock-2-line"></i>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>
                <!-- Seleção do Tipo de Acesso -->
                <div class="input-group">
                    <label for="tipo_acesso">Tipo de Acesso:</label>
                    <select name="tipo_acesso" id="tipo_acesso" required>
                        <option value="usuario_comum">Usuário Comum</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <!-- Seleção do Status -->
                <div class="input-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>
                <!-- Botão de Registro -->
                <button type="submit" class="btn-submit">Registrar</button>
                <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>
                <div class="register-footer">
                    <p class="footer-text">Já tem uma conta? <a href="login.php" class="link-login">Entrar</a></p>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
