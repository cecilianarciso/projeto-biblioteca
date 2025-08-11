<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../../models/LivroDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';

$usuario = $_SESSION['usuario']['id'];
$livroDao = new LivroDAO();
$resultado = $livroDao->buscarUsuario($usuario);

if (!isset($_SESSION['usuario'])) {
    header("Location: /../login/login.php");
    exit();
}

// Sanitiza as entradas
$titulo = Sanitizacao::sanitizar($_POST['titulo']);
$autor = Sanitizacao::sanitizar($_POST['autor']);
$isbn = Sanitizacao::sanitizar($_POST['isbn']);
$ano = Sanitizacao::sanitizar($_POST['ano']);

$LivroDAO = new LivroDAO();
$livro = $LivroDAO->criarLivro($titulo, $autor, $isbn, $ano, $_SESSION['usuario']['id']);

   header("Location: index.php");

