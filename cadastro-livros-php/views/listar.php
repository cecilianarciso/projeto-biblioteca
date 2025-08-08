<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros - Listagem</title>
    <style>
        /* Estilos CSS para uma interface limpa e responsiva */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .actions {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        
        .btn-danger {
            background-color: #f44336;
        }
        
        .btn-danger:hover {
            background-color: #da190b;
        }
        
        .btn-warning {
            background-color: #ff9800;
        }
        
        .btn-warning:hover {
            background-color: #e68900;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 2rem;
        }
        
        .book-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .book-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .book-info {
            color: #666;
            margin-bottom: 8px;
        }
        
        .book-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
        
        .book-actions .btn {
            padding: 8px 16px;
            font-size: 0.9rem;
            flex: 1;
            text-align: center;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stats {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .books-grid {
                grid-template-columns: 1fr;
            }
            
            .book-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho da aplicação -->
        <div class="header">
            <h1>📚 Cadastro de Livros</h1>
            <p>Sistema de gerenciamento de biblioteca pessoal</p>
        </div>
        
        <!-- Exibe mensagens de feedback -->
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?>">
                <?= htmlspecialchars($_SESSION['mensagem']) ?>
            </div>
            <?php 
            // Remove a mensagem da sessão após exibir
            unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); 
            ?>
        <?php endif; ?>
        
        <!-- Estatísticas -->
        <div class="stats">
            <h3>📊 Estatísticas</h3>
            <p><strong><?= count($livros) ?></strong> livro(s) cadastrado(s)</p>
        </div>
        
        <!-- Ações principais -->
        <div class="actions">
            <a href="index.php?acao=adicionar" class="btn">➕ Adicionar Novo Livro</a>
        </div>
        
        <!-- Lista de livros -->
        <?php if (empty($livros)): ?>
            <div class="empty-state">
                <h3>📖 Nenhum livro cadastrado</h3>
                <p>Comece adicionando seu primeiro livro à biblioteca!</p>
                <a href="index.php?acao=adicionar" class="btn">Adicionar Primeiro Livro</a>
            </div>
        <?php else: ?>
            <div class="books-grid">
                <?php foreach ($livros as $livro): ?>
                    <div class="book-card">
                        <div class="book-title">
                            📚 <?= htmlspecialchars($livro->getTitulo()) ?>
                        </div>
                        <div class="book-info">
                            <strong>Autor:</strong> <?= htmlspecialchars($livro->getAutor()) ?>
                        </div>
                        <div class="book-info">
                            <strong>Ano:</strong> <?= $livro->getAno() ?>
                        </div>
                        <div class="book-info">
                            <strong>ISBN:</strong> <?= htmlspecialchars($livro->getIsbn()) ?>
                        </div>
                        
                        <div class="book-actions">
                            <a href="index.php?acao=editar&id=<?= $livro->getId() ?>" 
                               class="btn btn-warning">✏️ Editar</a>
                            <a href="index.php?acao=excluir&id=<?= $livro->getId() ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                               🗑️ Excluir
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
