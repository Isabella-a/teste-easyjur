# Agenda de Tarefas

Esta aplicação permite a gestão de tarefas em uma agenda, com funcionalidades como criar, editar, excluir tarefas e gerar relatórios em formato PDF e Excel. A aplicação utiliza PHP para o backend, MySQL para o banco de dados e PhpSpreadsheet para exportação de dados.

## Funcionalidades

- **Cadastro de Tarefas**: Adicionar novas tarefas com nome, descrição, status e datas.
- **Edição de Tarefas**: Alterar dados das tarefas já cadastradas.
- **Exclusão de Tarefas**: Remover tarefas da agenda.
- **Relatórios**: Gerar relatórios das tarefas em formato PDF e Excel.
  
## Requisitos

- PHP 7.4 ou superior
- MySQL
- Composer para gerenciar dependências
- Extensões PHP necessárias: `pdo`, `pdo_mysql`, `gd`, `mbstring`

## Instalação

### 1. Clonar o Repositório

Clone o repositório para sua máquina local.

```bash
git clone https://github.com/seu-usuario/agenda-tarefas.git
cd agenda-tarefas
```

### 2. Configurar o Banco de Dados
Crie um banco de dados no MySQL com o nome agenda_tarefas.
Execute os scripts SQL para criar as tabelas necessárias. Exemplos de SQL podem ser encontrados no diretório src/db.

Tabela usuarios: Armazena os dados dos usuários.
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Tabela permissoes: Armazena as permissões por usuário.
```sql
CREATE TABLE permissoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    visualizar BOOLEAN DEFAULT FALSE,
    editar BOOLEAN DEFAULT FALSE,
    cadastrar BOOLEAN DEFAULT FALSE,
    excluir BOOLEAN DEFAULT FALSE,
    imprimir BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
```

Tabela tarefas: Armazena as tarefas.
```sql
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_conclusao TIMESTAMP NULL DEFAULT NULL,
    status ENUM('pendente', 'concluido') DEFAULT 'pendente',
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
```

### 3. Configuração do Banco de Dados
Edite o arquivo src/db/connection.php para configurar as credenciais do banco de dados:

```php
<?php
$host = 'localhost'; // Seu host de banco de dados
$dbname = 'agenda_tarefas'; // Nome do banco de dados
$username = 'root'; // Seu usuário de banco de dados
$password = ''; // Sua senha de banco de dados

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
```

### 4. Instalar Dependências
Se você não tiver o Composer instalado, faça o download e instale-o a partir de getcomposer.org.

Depois, execute o comando abaixo para instalar as dependências da aplicação:

```bash
composer install
```
Isso instalará o PhpSpreadsheet, que é usado para gerar os relatórios em Excel.

### 5. Configuração do Ambiente
Assegure-se de que o servidor web esteja configurado corretamente. Você pode usar o servidor embutido do PHP para testes locais.
```bash
php -S localhost:8000 -t public
```
Abra seu navegador e acesse http://localhost:8000/public/dashboard.php.

## Uso
### 1. Criar e Gerenciar Tarefas

Acesse a interface da aplicação através do seu navegador.
Cadastre, edite ou exclua tarefas diretamente na interface.
As tarefas podem ser visualizadas na página inicial após o login.

### 2. Gerar Relatórios

A aplicação permite gerar relatórios das tarefas em PDF e Excel.

PDF: Clique no link "Gerar Relatório PDF" para gerar um PDF com todas as tarefas.
Excel: Clique no link "Gerar Relatório Excel" para baixar as tarefas em formato Excel.

### 3. Exemplo de Como os Relatórios São Gerados

A geração do relatório no formato Excel utiliza a biblioteca PhpSpreadsheet. Ao clicar no link de exportação, os dados das tarefas são recuperados do banco de dados e organizados em um arquivo Excel, enquanto o PDF utiliza a biblioteca TCPDF para gerar o relatório em formato de tabela.

