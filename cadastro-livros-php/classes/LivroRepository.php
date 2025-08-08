<?php
/**
 * Classe LivroRepository - Gerencia a persistência dos livros
 * Implementa operações CRUD (Create, Read, Update, Delete)
 */
class LivroRepository
{
    private string $arquivoDados;
    
    /**
     * Construtor - Define o arquivo de dados
     */
    public function __construct()
    {
        $this->arquivoDados = __DIR__ . '/../data/livros.json';
        $this->criarArquivoSeNaoExistir();
    }
    
    /**
     * Cria o arquivo de dados se não existir
     */
    private function criarArquivoSeNaoExistir(): void
    {
        $diretorio = dirname($this->arquivoDados);
        
        // Cria o diretório se não existir
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        
        // Cria o arquivo com array vazio se não existir
        if (!file_exists($this->arquivoDados)) {
            file_put_contents($this->arquivoDados, json_encode([]));
        }
    }
    
    /**
     * Carrega todos os livros do arquivo JSON
     * @return array Array de objetos Livro
     */
    private function carregarLivros(): array
    {
        $conteudo = file_get_contents($this->arquivoDados);
        $dados = json_decode($conteudo, true) ?? [];
        
        $livros = [];
        foreach ($dados as $dadosLivro) {
            try {
                $livros[] = Livro::fromArray($dadosLivro);
            } catch (Exception $e) {
                // Log do erro (em produção, usar sistema de log adequado)
                error_log("Erro ao carregar livro: " . $e->getMessage());
            }
        }
        
        return $livros;
    }
    
    /**
     * Salva todos os livros no arquivo JSON
     * @param array $livros Array de objetos Livro
     * @return bool True se salvou com sucesso
     */
    private function salvarLivros(array $livros): bool
    {
        $dados = [];
        foreach ($livros as $livro) {
            $dados[] = $livro->toArray();
        }
        
        $json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($this->arquivoDados, $json) !== false;
    }
    
    /**
     * Adiciona um novo livro ao repositório
     * @param Livro $livro Livro a ser adicionado
     * @return bool True se adicionou com sucesso
     */
    public function adicionar(Livro $livro): bool
    {
        try {
            $livros = $this->carregarLivros();
            
            // Verifica se já existe um livro com o mesmo ISBN
            foreach ($livros as $livroExistente) {
                if ($livroExistente->getIsbn() === $livro->getIsbn()) {
                    throw new Exception('Já existe um livro com este ISBN');
                }
            }
            
            $livros[] = $livro;
            return $this->salvarLivros($livros);
        } catch (Exception $e) {
            error_log("Erro ao adicionar livro: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Lista todos os livros do repositório
     * @return array Array de objetos Livro
     */
    public function listarTodos(): array
    {
        return $this->carregarLivros();
    }
    
    /**
     * Busca um livro pelo ID
     * @param string $id ID do livro
     * @return Livro|null Livro encontrado ou null
     */
    public function buscarPorId(string $id): ?Livro
    {
        $livros = $this->carregarLivros();
        
        foreach ($livros as $livro) {
            if ($livro->getId() === $id) {
                return $livro;
            }
        }
        
        return null;
    }
    
    /**
     * Edita um livro existente
     * @param string $id ID do livro a ser editado
     * @param Livro $livroAtualizado Dados atualizados do livro
     * @return bool True se editou com sucesso
     */
    public function editar(string $id, Livro $livroAtualizado): bool
    {
        try {
            $livros = $this->carregarLivros();
            
            for ($i = 0; $i < count($livros); $i++) {
                if ($livros[$i]->getId() === $id) {
                    // Verifica se o ISBN não conflita com outro livro
                    foreach ($livros as $livroExistente) {
                        if ($livroExistente->getId() !== $id && 
                            $livroExistente->getIsbn() === $livroAtualizado->getIsbn()) {
                            throw new Exception('Já existe outro livro com este ISBN');
                        }
                    }
                    
                    // Mantém o ID original
                    $livroAtualizado->setId($id);
                    $livros[$i] = $livroAtualizado;
                    
                    return $this->salvarLivros($livros);
                }
            }
            
            return false; // Livro não encontrado
        } catch (Exception $e) {
            error_log("Erro ao editar livro: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Exclui um livro do repositório
     * @param string $id ID do livro a ser excluído
     * @return bool True se excluiu com sucesso
     */
    public function excluir(string $id): bool
    {
        try {
            $livros = $this->carregarLivros();
            $livrosAtualizados = [];
            $encontrou = false;
            
            foreach ($livros as $livro) {
                if ($livro->getId() !== $id) {
                    $livrosAtualizados[] = $livro;
                } else {
                    $encontrou = true;
                }
            }
            
            if ($encontrou) {
                return $this->salvarLivros($livrosAtualizados);
            }
            
            return false; // Livro não encontrado
        } catch (Exception $e) {
            error_log("Erro ao excluir livro: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Busca livros por título (busca parcial)
     * @param string $titulo Título ou parte do título
     * @return array Array de livros encontrados
     */
    public function buscarPorTitulo(string $titulo): array
    {
        $livros = $this->carregarLivros();
        $resultado = [];
        
        foreach ($livros as $livro) {
            if (stripos($livro->getTitulo(), $titulo) !== false) {
                $resultado[] = $livro;
            }
        }
        
        return $resultado;
    }
    
    /**
     * Conta o total de livros no repositório
     * @return int Número total de livros
     */
    public function contarTotal(): int
    {
        return count($this->carregarLivros());
    }
}
?>
