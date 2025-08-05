<?php
// Representa o modelo de um livro
class Livro {
    private string $titulo;
    private string $autor;
    private int $ano;
    private string $isbn;

    // Construtor para inicializar os atributos
    public function __construct(string $titulo, string $autor, int $ano, string $isbn) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->isbn = $isbn;
    }

    // Métodos getters para acessar propriedades privadas
    public function getTitulo(): string { return $this->titulo; }
    public function getAutor(): string { return $this->autor; }
    public function getAno(): int { return $this->ano; }
    public function getIsbn(): string { return $this->isbn; }

    // Métodos setters caso queira permitir edição
    public function setTitulo(string $titulo): void { $this->titulo = $titulo; }
    public function setAutor(string $autor): void { $this->autor = $autor; }
    public function setAno(int $ano): void { $this->ano = $ano; }
    public function setIsbn(string $isbn): void { $this->isbn = $isbn; }
}
