<?php
    require 'conexao.php';
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
        if ($_POST['acao'] === 'add') {
            $stmt = $conn->prepare('INSERT INTO responsavel (nome, telefone, email) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $_POST['nome'], $_POST['telefone'], $_POST['email']);
            $stmt->execute();
        } elseif ($_POST['acao'] === 'edit') {
            $stmt = $conn->prepare('UPDATE responsavel SET nome=?, telefone=?, email=? WHERE id=?');
            $stmt->bind_param('sssi', $_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['id']);
            $stmt->execute();
        }
        header('Location: gerenciar_responsaveis.php');
        exit;
    }
    if (isset($_GET['delete'])) {
        $stmt = $conn->prepare('DELETE FROM responsavel WHERE id=?');
        $stmt->bind_param('i', $_GET['delete']);
        $stmt->execute();
        header('Location: gerenciar_responsaveis.php');
        exit;
    }
    $res = $conn->query('SELECT * FROM responsavel ORDER BY id DESC');
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Responsáveis</title><link rel="stylesheet" href="assets/style.css"></head>
    <body>
      <header><h1>Gerenciar Responsáveis</h1><nav><a href="admin.php">Voltar</a></nav></header>
      <main>
        <section class="card">
          <h2>Adicionar / Editar</h2>
          <form method="post" onsubmit="return validateResp(this);">
            <input type="hidden" name="acao" value="add">
            <label>Nome:<input type="text" name="nome" required></label>
            <label>Telefone:<input type="text" name="telefone"></label>
            <label>Email:<input type="email" name="email"></label>
            <div><button type="submit">Salvar</button></div>
          </form>
        </section>
        <section class="card">
          <h2>Lista de Responsáveis</h2>
          <table>
            <thead><tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Ações</th></tr></thead>
            <tbody>
            <?php while($r = $res->fetch_assoc()): ?>
              <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nome']) ?></td>
                <td><?= htmlspecialchars($r['telefone']) ?></td>
                <td><?= htmlspecialchars($r['email']) ?></td>
                <td>
                  <a href="gerenciar_responsaveis.php?edit=<?= $r['id'] ?>">Editar</a> |
                  <a href="gerenciar_responsaveis.php?delete=<?= $r['id'] ?>" onclick="return confirm('Confirma?')">Excluir</a>
                </td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
      <script>
      function validateResp(form){
          if(!form.nome.value.trim()){ alert('Nome é obrigatório'); return false; }
          return true;
      }
      </script>
    </body>
    </html>
