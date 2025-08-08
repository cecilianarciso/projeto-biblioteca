<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - Cadastro de Livros</title>
    <style>
        /* Estilos CSS similares ao formulário de adição */
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #ff9800;
            box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
        }
        
        .form-group small {
            display: block;
            margin-top: 0.25rem;
            color: #666;
            font-size: 0.9rem;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-right: 10px;
        }
        
        .btn:hover {
            background-color: #e68900;
        }
        
        .btn-secondary {
            background-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #545b62;
        }
        
        .form-actions {
            margin-top: 2rem;
            text-align: center;
        }
        
        .back-link {
            margin-bottom: 2rem;
        }
        
        .back-link a {
            color: #ff9800;
            text-decoration: none;
            font-weight: bold;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .book-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 2rem;
            border-left: 4px solid #ff9800;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .form-container {
                padding: 1rem;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>✏️ Editar Livro</h1>
            <p>Modifique os dados do livro conforme necessário</p>
        </div>
        
        <!-- Link para voltar -->
        <div class="back-link">
            <a href="index.php">← Voltar para a lista de livros</a>
        </div>
        
        <!-- Informações atuais do livro -->
        <div class="book-info">
            <h3>📚 Editando: <?= htmlspecialchars($livro->getTitulo()) ?></h3>
            <p><strong>ID:</strong> <?= htmlspecialchars($livro->getId()) ?></p>
        </div>
        
        <!-- Formulário de edição -->
        <div class="form-container">
            <form method="POST" action="index.php">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($livro->getId()) ?>">
                
                <div class="form-group">
                    <label for="titulo">📖 Título do Livro *</label>
                    <input type="text" 
                           id="titulo" 
                           name="titulo" 
                           required 
                           maxlength="255"
                           value="<?= htmlspecialchars($livro->getTitulo()) ?>"
                           placeholder="Digite o título do livro">
                    <small>Título completo do livro</small>
                </div>
                
                <div class="form-group">
                    <label for="autor">✍️ Autor *</label>
                    <input type="text" 
                           id="autor" 
                           name="autor" 
                           required 
                           maxlength="255"
                           value="<?= htmlspecialchars($livro->getAutor()) ?>"
                           placeholder="Digite o nome do autor">
                    <small>Nome completo do autor principal</small>
                </div>
                
                <div class="form-group">
                    <label for="ano">📅 Ano de Publicação *</label>
                    <input type="number" 
                           id="ano" 
                           name="ano" 
                           required 
                           min="1000" 
                           max="<?= date('Y') + 1 ?>"
                           value="<?= $livro->getAno() ?>">
                    <small>Ano de publicação (entre 1000 e <?= date('Y') + 1 ?>)</small>
                </div>
                
                <div class="form-group">
                    <label for="isbn">🔢 ISBN *</label>
                    <input type="text" 
                           id="isbn" 
                           name="isbn" 
                           required 
                           value="<?= htmlspecialchars($livro->getIsbn()) ?>"
                           pattern="[0-9X\-]*"
                           title="Digite apenas números, hífens e X">
                    <small>Código ISBN do livro (apenas números, hífens e X)</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn">💾 Salvar Alterações</button>
                    <a href="index.php" class="btn btn-secondary">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript para melhorar a experiência do usuário
        document.addEventListener('DOMContentLoaded', function() {
            // Foca no primeiro campo ao carregar a página
            document.getElementById('titulo').focus();
            
            // Formata o ISBN automaticamente
            const isbnInput = document.getElementById('isbn');
            isbnInput.addEventListener('input', function(e) {
                // Remove caracteres não permitidos
                let value = e.target.value.replace(/[^0-9X\-]/gi, '');
                e.target.value = value.toUpperCase();
            });
            
            // Validação em tempo real
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const titulo = document.getElementById('titulo').value.trim();
                const autor = document.getElementById('autor').value.trim();
                const ano = parseInt(document.getElementById('ano').value);
                const isbn = document.getElementById('isbn').value.trim();
                
                if (!titulo || !autor || !ano || !isbn) {
                    alert('Por favor, preencha todos os campos obrigatórios.');
                    e.preventDefault();
                    return;
                }
                
                const anoAtual = new Date().getFullYear();
                if (ano < 1000 || ano > anoAtual + 1) {
                    alert(`O ano deve estar entre 1000 e ${anoAtual + 1}.`);
                    e.preventDefault();
                    return;
                }
                
                // Confirmação antes de salvar
                if (!confirm('Deseja salvar as alterações neste livro?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
