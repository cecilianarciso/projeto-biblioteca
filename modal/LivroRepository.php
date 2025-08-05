<?php
require_once 'Livro.php';

// Gerencia o armazenamento dos livros
class LivroRepository {
    private string $arquivo = __DIR__ . '/../data/livros.json';

    // Lê os livros salvos
    public function listar(): array {
        if (!file_exists($this->arquivo)) return [];
        $json = file_get_contents($this->arquivo);
        $dados = json_decode($json, true);
        $livros = [];

        // Reconstrói os objetos Livro
        foreach ($dados as $item) {
            $livros[] = new Livro($item['titulo'], $item['autor'], $item['ano'], $item['isbn']);
        }
        return $livros;
    }

    // Salva todos os livros no JSON
    private function salvar(array $livros): void {
        $dados = array_map(fn($livro) => [
            'titulo' => $livro->getTitulo(),
            'autor' => $livro->getAutor(),
            'ano' => $livro->getAno(),
            'isbn' => $livro->getIsbn()
        ], $livros);
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // Adiciona um novo livro
    public function adicionar(Livro $livro): void {
        $livros = $this->listar();
        $livros[] = $livro;
        $this->salvar($livros);
    }

    // Exclui livro pelo índice
    public function excluir(int $index): void {
        $livros = $this->listar();
        if (isset($livros[$index])) {
            array_splice($livros, $index, 1);
            $this->salvar($livros);
        }
    }

    // Edita livro no índice
    public function editar(int $index, Livro $novoLivro): void {
        $livros = $this->listar();
        if (isset($livros[$index])) {
            $livros[$index] = $novoLivro;
            $this->salvar($livros);
        }
    }
}
