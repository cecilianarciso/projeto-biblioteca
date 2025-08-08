<?php
/**
 * Arquivo principal da aplicação de cadastro de livros
 * Gerencia as rotas e inicializa a aplicação
 */

// Inclui as classes necessárias
require_once 'classes/Livro.php';
require_once 'classes/LivroRepository.php';

// Inicia a sessão para controle de estado
session_start();

// Instancia o repositório de livros
$livroRepository = new LivroRepository();

// Captura a ação solicitada via GET ou POST
$acao = $_GET['acao'] ?? $_POST['acao'] ?? 'listar';

// Processa as diferentes ações
switch ($acao) {
    case 'adicionar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Cria novo livro com dados do formulário
            $livro = new Livro(
                $_POST['titulo'],
                $_POST['autor'],
                (int)$_POST['ano'],
                $_POST['isbn']
            );
            
            // Adiciona o livro ao repositório
            if ($livroRepository->adicionar($livro)) {
                $_SESSION['mensagem'] = 'Livro adicionado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';
            } else {
                $_SESSION['mensagem'] = 'Erro ao adicionar livro!';
                $_SESSION['tipo_mensagem'] = 'error';
            }
            
            // Redireciona para evitar reenvio do formulário
            header('Location: index.php');
            exit;
        }
        include 'views/adicionar.php';
        break;
        
    case 'editar':
        $id = $_GET['id'] ?? $_POST['id'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            // Atualiza o livro com novos dados
            $livroAtualizado = new Livro(
                $_POST['titulo'],
                $_POST['autor'],
                (int)$_POST['ano'],
                $_POST['isbn']
            );
            
            if ($livroRepository->editar($id, $livroAtualizado)) {
                $_SESSION['mensagem'] = 'Livro editado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';
            } else {
                $_SESSION['mensagem'] = 'Erro ao editar livro!';
                $_SESSION['tipo_mensagem'] = 'error';
            }
            
            header('Location: index.php');
            exit;
        }
        
        // Busca o livro para edição
        $livro = $livroRepository->buscarPorId($id);
        if (!$livro) {
            $_SESSION['mensagem'] = 'Livro não encontrado!';
            $_SESSION['tipo_mensagem'] = 'error';
            header('Location: index.php');
            exit;
        }
        
        include 'views/editar.php';
        break;
        
    case 'excluir':
        $id = $_GET['id'] ?? null;
        
        if ($id && $livroRepository->excluir($id)) {
            $_SESSION['mensagem'] = 'Livro excluído com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
        } else {
            $_SESSION['mensagem'] = 'Erro ao excluir livro!';
            $_SESSION['tipo_mensagem'] = 'error';
        }
        
        header('Location: index.php');
        exit;
        
    case 'listar':
    default:
        // Lista todos os livros
        $livros = $livroRepository->listarTodos();
        include 'views/listar.php';
        break;
}
?>
