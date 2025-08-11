<?php
require_once 'Livro.php';
require_once __DIR__ . '/../config/Database.php';

class LivroDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //Verifica se o ID existe no banco
    public function buscarId($id) {
        $query = "SELECT * FROM livros WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Busca todos os livros com o ID do usuario logado
    public function buscarUsuario($usuario_id) {
        $query = "SELECT * FROM livros WHERE usuarios_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria um novo livro
    public function criarLivro($titulo, $autor, $isbn, $ano, $usuarios_id) {
        $query = "INSERT INTO livros (titulo, autor, isbn, ano, usuarios_id) VALUES (:titulo, :autor, :isbn, :ano, :usuarios_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':usuarios_id', $usuarios_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $this->buscarUsuario($usuarios_id);
        }
        return null;
    }

    public function editarLivro($id, $titulo, $autor, $isbn, $ano) {
        if (!$this->buscarId($id)) {
            return null; 
        }
        $query = "UPDATE livros SET titulo = :titulo, autor = :autor, isbn = :isbn, ano = :ano WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $this->buscarId($id);
        }
        return null;
    }

    // Deletar o livro
      public function deletarLivro($id) {
        if (!$this->buscarId($id)) {
            return null;
        }
        $query = "DELETE FROM livros WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }  
}
