<?php

class Usuario {
    // Propriedades privadas para encapsular os dados do usuário
    private $id;          // Identificador único do usuário (geralmente autoincrementado no banco)
    private $nome;         
    private $email;       // E-mail do usuário (usado como login/identificador único)
    private $senha_hash;  // Senha do usuário armazenada de forma segura (hash)
    private $created_at;  // Data/hora de criação do usuário (geralmente definida pelo banco)

    public function __construct($data) {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->senha_hash = $data['senha_hash'];
        $this->created_at = $data['created_at'];
    }

    // Getters (métodos para acessar os valores das propriedades)
    public function getId() { 
        return $this->id; 
    }

    public function getNome() { 
        return $this->nome; 
    }

    public function getEmail() { 
        return $this->email; 
    }

    public function getSenhaHash() { 
        return $this->senha_hash; 
    }

    public function getCreatedAt() { 
        return $this->created_at; 
    }

    // Setters (métodos para definir/modificar os valores das propriedades)
    public function setNome($nome) { 
        $this->nome = $nome; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }

    public function setSenhaHash($senha_hash) { 
        $this->senha_hash = $senha_hash; 
    }
}
?>
