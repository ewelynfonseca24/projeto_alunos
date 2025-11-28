<?php
    require 'conexao.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
        if ($_POST['acao'] === 'add') {
            $stmt = $conn->prepare('INSERT INTO serie (nome) VALUES (?)');
            $stmt->bind_param('s', $_POST['nome']);
            $stmt->execute();
        } elseif ($_POST['acao'] === 'edit') {
            $stmt = $conn->prepare('UPDATE serie SET nome=? WHERE id=?');
            $stmt->bind_param('si', $_POST['nome'], $_POST['id']);
            $stmt->execute();
        }
        header('Location: gerenciar_series.php');
        exit;
    }
    if (isset($_GET['delete'])) {
        $stmt = $conn->prepare('DELETE FROM serie WHERE id=?');
        $stmt->bind_param('i', $_GET['delete']);
        $stmt->execute();
        header('Location: gerenciar_series.php');
        exit;
    }
    $res = $conn->query('SELECT * FROM serie ORDER BY id DESC');
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Séries</title><link rel="stylesheet" href="assets/style.css"></head>
    <body>
      <header><h1>Gerenciar Séries</h1><nav><a href="admin.php">Voltar</a></nav></header>
      <main>
        <section class="card">
          <h2>Adicionar Série</h2>
          <form method="post">
            <input type="hidden" name="acao" value="add">
            <label>Nome:<input type="text" name="nome" required></label>
            <div><button type="submit">Salvar</button></div>
          </form>
        </section>
        <section class="card">
          <h2>Lista de Séries</h2>
          <table>
            <thead><tr><th>ID</th><th>Nome</th><th>Ações</th></tr></thead>
            <tbody>
            <?php while($r = $res->fetch_assoc()): ?>
              <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nome']) ?></td>
                <td>
                  <a href="gerenciar_series.php?edit=<?= $r['id'] ?>">Editar</a> |
                  <a href="gerenciar_series.php?delete=<?= $r['id'] ?>" onclick="return confirm('Confirma?')">Excluir</a>
                </td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
    </body>
    </html>
