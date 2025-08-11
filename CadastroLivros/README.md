# 📚 Cadastro de Livros
Um sistema simples de gerenciamento de livros com funcionalidades de : Cadastra e logar os usuário além de cadatrar , editar e excluir livros. 

#🚀 Começando
Estas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e testes.

Consulte a seção 📦 Implantação para saber como colocar o projeto em produção.

#📋 Pré-requisitos
Para rodar este projeto localmente, você precisará:

PHP 7.4+

Servidor XAMPP.

MySQL

Navegador Web



# 🔧 Instalação
1. Clone o repositório
bash
Copiar
Editar
git clone https://github.com/PietraMassarotti/CadastroLivros.git
2. Configure o ambiente
Crie um banco de dados no MySQL:

sql
Copiar
Editar
CREATE DATABASE cadastro_livros;
Importe o script SQL (se existir) ou crie a tabela de livros e usuários com base nos arquivos DAO e Models.

# 🎲 Script do Banco de Dados

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sistema_livro
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistema_livro
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistema_livro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `sistema_livro` ;

-- -----------------------------------------------------
-- Table `sistema_livro`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_livro`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sistema_livro`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_livro`.`livros` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `autor` VARCHAR(255) NOT NULL,
  `isbn` VARCHAR(20) NOT NULL,
  `ano` SMALLINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuarios_id`),
  UNIQUE INDEX `isbn` (`isbn` ASC) VISIBLE,
  INDEX `fk_livros_usuarios_idx` (`usuarios_id` ASC) VISIBLE,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  CONSTRAINT `fk_livros_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `sistema_livro`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;






3. Configure a conexão com o banco
Edite o arquivo config/Database.php com os dados do seu MySQL:

php
Copiar
Editar
private $host = "localhost";
private $db_name = "cadastro_livros";
private $username = "root";
private $password = "Sua senha do Banco de Dados";
4. Inicie o servidor local
Se estiver usando XAMPP ou Laragon, mova a pasta para htdocs ou www e acesse no navegador:

http://localhost/cadastrodelivros/public/

# 💡 Como Usar
Faça login ou crie um usuário.

Acesse a área de livros.

Cadastre, edite, visualize ou delete os livros conforme necessário.

# ⚙️ Executando os testes
Atualmente, o projeto não possui testes automatizados. Você pode realizar testes manuais:

Testar o login com dados válidos/ inválidos.

Criar, editar e deletar livros.

Verificar mensagens de erro e sucesso.

# 🔩 Testes de ponta a ponta
A lógica é validada nas camadas:

UsuarioDAO / LivroDAO fazem a comunicação com o banco.

form_*.php contém formulários de entrada e redirecionamento.

Validação manual de dados inseridos.

# ⌨️ Testes de estilo de codificação
O código segue o padrão estrutural MVC básico:

Models: Lógica das entidades.

DAOs: Manipulação de dados no banco.

Public: HTML e PHP das páginas acessíveis.

Utils: Scripts auxiliares de validação e segurança.

# 📦 Implantação
Para implantar este sistema em um ambiente ativo (ex: servidor VPS ou hospedagem):

Envie os arquivos via FTP/SFTP.

Configure corretamente o banco de dados no servidor.

Aponte o domínio para a pasta public/.

Configure o .htaccess se necessário para URLs amigáveis.

# 🛠️ Construído com
PHP - Linguagem principal

MySQL - Banco de dados

HTML/CSS - Estrutura visual

VSCode - Editor de código

XAMPP/Laragon - Ambiente local recomendado

# 📁 Estrutura de Pastas

CadastroDeLivros/
├── config/
│   └── Database.php
│
├── models/
│   ├── Livro.php
│   ├── LivroDAO.php
│   ├── Usuario.php
│   └── UsuarioDAO.php
│
├── public/
│   ├── livros/
│   │   ├── css/
│   │   │   ├── form.css
│   │   │   └── tabela.css
│   │   ├── criar_livro.php
│   │   ├── deletar_livro.php
│   │   ├── editar_livro.php
│   │   ├── form_criar.php
│   │   ├── form_editar.php
│   │   ├── index.php
│   │   └── logout.php
│   │
│   ├── login/
│   │   ├── css/
│   │   │   ├── form.css
│   │   │   └── tabela.css
│   │   ├── cadastro.php
│   │   ├── criar_user.php
│   │   ├── index.php
│   │   ├── login.php
│   │   └── process_login.php
│
├── utils/
│   ├── Sanitizacao.php
│   ├── SenhaValidacao.php
│   └── ver_senha.php
│




# ✒️ Autores
BackEnd - Pietra Massarotti 

FrontEnd - Maria Cecília

Documentação - Julia Júlio do Carmo

