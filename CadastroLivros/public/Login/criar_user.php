<?php
session_start();

require_once __DIR__ . '/../../models/UsuarioDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';
require_once __DIR__ . '/../../utils/SenhaValidacao.php';

$nome = Sanitizacao::sanitizar($_POST['nome']);
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);
$mensagemErroSenha = SenhaValidacao::validarSenha($senha);

if ($mensagemErroSenha) {
    $_SESSION['mensagem'] = $mensagemErroSenha;
    header("Location: cadastro.php");
    exit();
}

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->criarUser ($nome, $email, $senha);

if ($usuario) {
    $_SESSION['mensagem'] = "Usuário criado com sucesso! :)";
} else {
    $_SESSION['mensagem'] = "Erro ao criar usuário :(. Esse email pode já estar sendo utilizado.";
}

header("Location: cadastro.php");
exit();
?>
