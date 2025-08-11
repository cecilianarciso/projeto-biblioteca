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

<head>
    <title>Livros</title>
    <link rel="stylesheet" type="text/css" href="css/tabela.css" media="screen" />
</head>

<body>
    <h1>Bem vindo!</h1>
    <h2>Meus livros:</h2>
    <a href="form_criar.php">Adicionar livro</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Ano</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['autor'] ?></td>
                    <td><?= $row['isbn'] ?></td>
                    <td><?= $row['ano'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['update_at'] ?></td>
                    <div class="btn-actions">
                        <td>
                            <a href="form_editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="deletar_livro.php?id=<?= $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </div>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <div class="actions">
        <a href="logout.php" class="btn btn-exit">Sair</a>
    </div>
</body>

</html>
