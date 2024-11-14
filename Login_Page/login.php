<?php
session_start();
include('./includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email AND status = 'ativo'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificação direta da senha (sem hashing)
    if ($usuario && $usuario['senha'] === $senha) {
        // Inicia a sessão do usuário
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_tipo_acesso'] = $usuario['tipo_acesso'];

        // Redireciona o usuário
        if ($usuario['tipo_acesso'] == "usuario_comum")
            header("Location: index.php");
        else
            header("Location: dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ===================== CSS ===================== -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- ===================== REMIXICON ===================== -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Login - EF-Security</title>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="POST" class="login-form" id="login-form">
            <div class="login-header">
                <i class="ri-secure-payment-line logo"></i>
                <p class="logo-text">EF-SECURITY</p>
                <h1 class="login-title">Bem-vindo de volta!</h1>
                <p class="login-subtitle">Mantenha-se seguro em todas as situações. Faça login para começar.</p>
            </div>
            <div class="login-inputs">
                <!-- Input de E-mail -->
                <div class="input-group">
                    <i class="ri-user-3-line"></i>
                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                <!-- Input de Senha -->
                <div class="input-group">
                    <i class="ri-lock-2-line"></i>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>
                <!-- Botão de Login -->
                <button type="submit" class="btn-submit">Entrar</button>
                <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>
                <div class="login-footer">
                    <p class="footer-text">Ainda não tem uma conta? <a href="register.php" class="link-register">Registre-se</a></p>
                </div>
            </div>
        </form>
    </div>
    <!-- ===================== JS ===================== -->
    <script src="../assets/js/script.js"></script>
</body>
</html>
