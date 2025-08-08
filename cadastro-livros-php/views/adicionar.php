<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro - Cadastro de Livros</title>
    <style>
        /* Estilos CSS reutilizados e específicos para formulários */
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
            background-color: #4CAF50;
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
            background-color: #45a049;
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
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        
        .back-link a:hover {
            text-decoration: underline;
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
            <h1>➕ Adicionar Novo Livro</h1>
            <p>Preencha os dados do livro para adicioná-lo à sua biblioteca</p>
        </div>
        
        <!-- Link para voltar -->
        <div class="back-link">
            <a href="index.php">← Voltar para a lista de livros</a>
        </div>
        
        <!-- Formulário de adição -->
        <div class="form-container">
            <form method="POST" action="index.php">
                <input type="hidden" name="acao" value="adicionar">
                
                <div class="form-group">
                    <label for="titulo">📖 Título do Livro *</label>
                    <input type="text" 
                           id="titulo" 
                           name="titulo" 
                           required 
                           maxlength="255"
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
                           placeholder="<?= date('Y') ?>">
                    <small>Ano de publicação (entre 1000 e <?= date('Y') + 1 ?>)</small>
                </div>
                
                <div class="form-group">
                    <label for="isbn">🔢 ISBN *</label>
                    <input type="text" 
                           id="isbn" 
                           name="isbn" 
                           required 
                           placeholder="978-85-123-4567-8"
                           pattern="[0-9X\-]*"
                           title="Digite apenas números, hífens e X">
                    <small>Código ISBN do livro (apenas números, hífens e X)</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn">💾 Salvar Livro</button>
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
                if (!confirm('Deseja salvar este livro?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
