<?php

class Livro {
    // Propriedades privadas do livro
    private $id;
    private $titulo;
    private $autor;
    private $isbn;
    private $ano;
    private $created_at;
    private $updated_at;
    private $usuarios_id; // ID do usuário que cadastrou o livro

    // Construtor: inicializa os dados com um array associativo
    public function __construct($data) {
        $this->id = $data['id'];
        $this->titulo = $data['titulo'];
        $this->autor = $data['autor'];
        $this->isbn = $data['isbn'];
        $this->ano = $data['ano'];
        $this->created_at = $data['created_at'];
        $this->updated_at = $data['updated_at'];
        $this->usuarios_id = $data['usuarios_id'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getIsbn() {
        return $this->isbn;
    }

     public function getAno() {
        return $this->ano;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function getUsuarioId() {
        return $this->usuarios_id;
    }

    // Setters
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

      public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function setUsuarioId($usuarios_id) {
        $this->usuarios_id = $usuarios_id;
    }
}
?>
