<?php
require_once '../modal/LivroRepository.php';

$repo = new LivroRepository();
$livros = $repo->listar();
?>

<h2>Lista de Livros</h2>
<ul>
<?php foreach ($livros as $index => $livro): ?>
    <li>
        <?= $livro->getTitulo() ?> por <?= $livro->getAutor() ?> (<?= $livro->getAno() ?>) - ISBN: <?= $livro->getIsbn() ?>
        <a href="index.php?delete=<?= $index ?>">Excluir</a>
    </li>
<?php endforeach; ?>
</ul>

