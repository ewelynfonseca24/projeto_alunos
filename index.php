<?php
    require 'conexao.php';
    
    $sql = "SELECT a.*, r.nome as responsavel_nome, s.nome as serie_nome
            FROM aluno a
            LEFT JOIN responsavel r ON a.responsavel_id = r.id
            LEFT JOIN serie s ON a.serie_id = s.id
            ORDER BY a.id DESC";
    $res = $conn->query($sql);
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Lista de Alunos</title>
      <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
      <header>
        <h1>Cadastro de Alunos</h1>
        <nav>
          <a href="index.php">Alunos</a> |
          <a href="adicionar_aluno.php">Adicionar Aluno</a> |
          <a href="admin.php">Admin</a>
        </nav>
      </header>
      <main>
        <section class="card">
          <h2>Alunos Cadastrados</h2>
          <table>
            <thead>
              <tr><th>ID</th><th>Nome</th><th>Matrícula</th><th>Série</th><th>Responsável</th><th>Ações</th></tr>
            </thead>
            <tbody>
            <?php while($row = $res->fetch_assoc()): ?>
              <tr>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['nome'])?></td>
                <td><?=htmlspecialchars($row['matricula'])?></td>
                <td><?=htmlspecialchars($row['serie_nome'])?></td>
                <td><?=htmlspecialchars($row['responsavel_nome'])?></td>
                <td>
                  <a href="editar_aluno.php?id=<?= $row['id'] ?>">Editar</a> |
                  <a href="excluir_aluno.php?id=<?= $row['id'] ?>" onclick="return confirm('Confirma exclusão?')">Excluir</a>
                </td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
      <script src="assets/app.js"></script>
    </body>
    </html>
