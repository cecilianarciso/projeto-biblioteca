<?php
/**
 * Classe Livro - Representa um livro no sistema
 * Implementa encapsulamento e validação de dados
 */
class Livro
{
    // Propriedades privadas para encapsulamento
    private string $titulo;
    private string $autor;
    private int $ano;
    private string $isbn;
    private string $id;
    
    /**
     * Construtor da classe Livro
     * @param string $titulo Título do livro
     * @param string $autor Autor do livro
     * @param int $ano Ano de publicação
     * @param string $isbn ISBN do livro
     */
    public function __construct(string $titulo, string $autor, int $ano, string $isbn)
    {
        $this->setTitulo($titulo);
        $this->setAutor($autor);
        $this->setAno($ano);
        $this->setIsbn($isbn);
        $this->id = uniqid(); // Gera ID único para o livro
    }
    
    // Métodos Getters - Permitem acesso controlado às propriedades
    public function getId(): string
    {
        return $this->id;
    }
    
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    
    public function getAutor(): string
    {
        return $this->autor;
    }
    
    public function getAno(): int
    {
        return $this->ano;
    }
    
    public function getIsbn(): string
    {
        return $this->isbn;
    }
    
    // Métodos Setters - Permitem modificação controlada das propriedades
    public function setId(string $id): void
    {
        $this->id = $id;
    }
    
    public function setTitulo(string $titulo): void
    {
        if (empty(trim($titulo))) {
            throw new InvalidArgumentException('Título não pode estar vazio');
        }
        $this->titulo = trim($titulo);
    }
    
    public function setAutor(string $autor): void
    {
        if (empty(trim($autor))) {
            throw new InvalidArgumentException('Autor não pode estar vazio');
        }
        $this->autor = trim($autor);
    }
    
    public function setAno(int $ano): void
    {
        $anoAtual = (int)date('Y');
        if ($ano < 1000 || $ano > $anoAtual + 1) {
            throw new InvalidArgumentException('Ano deve estar entre 1000 e ' . ($anoAtual + 1));
        }
        $this->ano = $ano;
    }
    
    public function setIsbn(string $isbn): void
    {
        // Remove caracteres não numéricos do ISBN
        $isbn = preg_replace('/[^0-9X]/', '', strtoupper($isbn));
        
        if (empty($isbn)) {
            throw new InvalidArgumentException('ISBN não pode estar vazio');
        }
        
        $this->isbn = $isbn;
    }
    
    /**
     * Converte o objeto para array (útil para serialização)
     * @return array Representação em array do livro
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'ano' => $this->ano,
            'isbn' => $this->isbn
        ];
    }
    
    /**
     * Cria um objeto Livro a partir de um array
     * @param array $data Dados do livro em formato array
     * @return Livro Nova instância de Livro
     */
    public static function fromArray(array $data): Livro
    {
        $livro = new self($data['titulo'], $data['autor'], $data['ano'], $data['isbn']);
        if (isset($data['id'])) {
            $livro->setId($data['id']);
        }
        return $livro;
    }
    
    /**
     * Representação em string do livro
     * @return string Descrição do livro
     */
    public function __toString(): string
    {
        return "{$this->titulo} - {$this->autor} ({$this->ano})";
    }
}
?>
