<?php
require_once '../modal/LivroRepository.php';
require_once '../modal/Livro.php';

$repo = new LivroRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro = new Livro($_POST['titulo'], $_POST['autor'], (int)$_POST['ano'], $_POST['isbn']);
    $repo->adicionar($livro);
    header('Location: index.php');
}

if (isset($_GET['delete'])) {
    $repo->excluir((int)$_GET['delete']);
    header('Location: index.php');
}

include '../view/form.html';
include '../view/lista.php';
