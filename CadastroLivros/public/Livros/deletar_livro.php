<?php
session_start();
require_once __DIR__ . '/../../models/LivroDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /../login/login.php");
    exit();
}

// Sanitiza as entradas
$id = Sanitizacao::sanitizar($_GET['id']);

$LivroDAO = new LivroDAO();
$livro = $LivroDAO->deletarLivro($id);

header("Location: index.php");
