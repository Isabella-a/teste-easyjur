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
git clone https://github.com/Isabella-a/teste-easyjur.git
cd teste-tecnico-php
```

### 2. Configurar o Banco de Dados
Certifique-se de que o MySQL está rodando.
Execute o script SQL localizado em sql/database.sql para criar as tabelas necessárias:
```bash
mysql -u [usuario] -p < database.sql
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

PDF: Clique no link "Exportar para PDF" para gerar um PDF com todas as tarefas.
Excel: Clique no link "Exportar para Excel" para baixar as tarefas em formato Excel.

### 3. Como os elatórios São Gerados

A geração do relatório no formato Excel utiliza a biblioteca PhpSpreadsheet. Ao clicar no link de exportação, os dados das tarefas são recuperados do banco de dados e organizados em um arquivo Excel, enquanto o PDF utiliza a biblioteca TCPDF para gerar o relatório em formato de tabela.

