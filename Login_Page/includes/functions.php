<?php

// Função para criptografar a senha
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Função para verificar a senha
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

?>
