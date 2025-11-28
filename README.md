## Descrição
Site simples para cadastro de alunos com 3 tabelas: `responsavel`, `serie` e `aluno`.
Funcionalidades:
- CRUD de alunos (Create, Read, Update, Delete)
- CRUD de responsáveis
- CRUD de séries
- Página administrativa para gerenciar registros
- Validações em JavaScript
- Conexão MySQL via `conexao.php`

## Como usar (XAMPP)
1. Copie a pasta `alunos_project` para `C:\xampp\htdocs\` (Windows) ou `/opt/lampp/htdocs/` (Linux) mantendo a estrutura.
2. No painel do XAMPP, inicie Apache e MySQL.
3. Crie o banco de dados importando o arquivo `database.sql` via phpMyAdmin (ou execute o conteúdo SQL).
4. Ajuste `conexao.php` se necessário (usuário/senha do MySQL). Por padrão usa `root` sem senha.
5. Acesse no navegador: `http://localhost/alunos_project/`

## Credenciais padrão MySQL (XAMPP)
- Host: localhost
- Usuário: root
- Senha: (vazia)

## Autor do projeto
Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.
