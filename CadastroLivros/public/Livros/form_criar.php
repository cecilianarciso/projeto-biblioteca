<?php
    session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../../models/LivroDAO.php';

$usuario = $_SESSION['usuario']['id'];
$livroDao = new LivroDAO();
$resultado = $livroDao->buscarUsuario($usuario);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Adicionar livro</title>
    <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
</head>

<body>
    <h1>Adicionar</h1>
    <form action="criar_livro.php" method="POST">
        <label>Título:</label>
        <input type="text" name="titulo" required>
        <label>Autor:</label>
        <input type="text" name="autor" required>
        <label>ISBN:</label>
        <input type="number" name="isbn" minlength="13" maxlength="15" required>
        <label>Ano:</label>
        <input type="date" name="ano">
        <input type="hidden" name="usuarios_id" value="resultado"/>
         <button type="submit">Adicionar</button>
    </form>
    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>

</body>

</html>
