# 📚 Sistema de Cadastro de Livros

Sistema desenvolvido em PHP com Programação Orientada a Objetos para gerenciar um cadastro de livros.

## 🎯 Funcionalidades

- ➕ **Adicionar livros** - Cadastro de novos livros com validação
- 📋 **Listar livros** - Visualização de todos os livros cadastrados
- ✏️ **Editar livros** - Modificação de dados de livros existentes
- 🗑️ **Excluir livros** - Remoção de livros do cadastro
- 🔍 **Validações** - Validação de dados e prevenção de duplicatas

## 🏗️ Arquitetura

### Estrutura de Pastas
\`\`\`
/
├── index.php              # Arquivo principal (controlador)
├── classes/               # Classes do sistema
│   ├── Livro.php         # Modelo de dados do livro
│   └── LivroRepository.php # Repositório para persistência
├── views/                 # Interfaces do usuário
│   ├── listar.php        # Listagem de livros
│   ├── adicionar.php     # Formulário de adição
│   └── editar.php        # Formulário de edição
├── data/                  # Armazenamento de dados
│   └── livros.json       # Arquivo JSON com os livros
└── README.md             # Documentação
\`\`\`

### Classes Principais

#### 🔹 Classe Livro
- **Propriedades**: título, autor, ano, isbn, id
- **Métodos**: getters, setters, validações, serialização
- **Encapsulamento**: Propriedades privadas com acesso controlado

#### 🔹 Classe LivroRepository
- **Responsabilidade**: Gerenciar persistência dos dados
- **Métodos CRUD**: adicionar(), listarTodos(), editar(), excluir()
- **Armazenamento**: Arquivo JSON para simplicidade

## 🚀 Como Usar

1. **Configuração**
   - Certifique-se de ter PHP 8.0+ instalado
   - Clone ou baixe os arquivos do projeto
   - Coloque em um servidor web (Apache, Nginx) ou use o servidor built-in do PHP

2. **Executar**
   \`\`\`bash
   # Usando servidor built-in do PHP
   php -S localhost:8000
   \`\`\`

3. **Acessar**
   - Abra o navegador em `http://localhost:8000`
   - Comece adicionando livros à sua biblioteca

## 🛡️ Validações Implementadas

- **Título**: Não pode estar vazio
- **Autor**: Não pode estar vazio  
- **Ano**: Deve estar entre 1000 e ano atual + 1
- **ISBN**: Não pode estar vazio, aceita apenas números, hífens e X
- **Duplicatas**: Não permite livros com mesmo ISBN

## 🎨 Interface

- Design responsivo e moderno
- Feedback visual para ações do usuário
- Confirmações para ações destrutivas
- Validação em tempo real nos formulários

## 🔧 Tecnologias Utilizadas

- **PHP 8.0+** - Linguagem principal
- **POO** - Paradigma de programação
- **JSON** - Armazenamento de dados
- **HTML5/CSS3** - Interface do usuário
- **JavaScript** - Melhorias na experiência do usuário

## 📝 Observações Técnicas

- Sistema utiliza sessões PHP para feedback de mensagens
- Dados são persistidos em arquivo JSON para simplicidade
- Validações tanto no frontend quanto no backend
- Tratamento de erros e logs de sistema
- Código documentado e seguindo boas práticas

## 🔄 Possíveis Melhorias

- Implementar busca e filtros
- Adicionar paginação para muitos livros
- Integrar com banco de dados real
- Adicionar sistema de categorias
- Implementar upload de capas de livros
- Adicionar exportação de dados (CSV, PDF)

---

**Desenvolvido como projeto acadêmico demonstrando conceitos de POO em PHP**
