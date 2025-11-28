<?php
    require 'conexao.php';
    $id = $_GET['id'] ?? null;
    if (!$id) header('Location: index.php');
  
    $stmt = $conn->prepare('SELECT * FROM aluno WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $resp = $conn->query("SELECT id, nome FROM responsavel ORDER BY nome");
    $series = $conn->query("SELECT id, nome FROM serie ORDER BY nome");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $data = $_POST['data_nascimento']?:NULL;
        $matricula = $_POST['matricula'];
        $responsavel_id = $_POST['responsavel_id']?:NULL;
        $serie_id = $_POST['serie_id']?:NULL;
        $stmt = $conn->prepare('UPDATE aluno SET nome=?, data_nascimento=?, matricula=?, responsavel_id=?, serie_id=? WHERE id=?');
        $stmt->bind_param('sssssi', $nome, $data, $matricula, $responsavel_id, $serie_id, $id);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Editar Aluno</title><link rel="stylesheet" href="assets/style.css"></head>
    <body>
      <header><h1>Editar Aluno</h1><nav><a href="index.php">Voltar</a></nav></header>
      <main>
        <section class="card">
          <form id="alunoForm" method="post" action="">
            <label>Nome:<input type="text" name="nome" required value="<?= htmlspecialchars($res['nome']) ?>"></label>
            <label>Data de Nascimento:<input type="date" name="data_nascimento" value="<?= htmlspecialchars($res['data_nascimento']) ?>"></label>
            <label>Matrícula:<input type="text" name="matricula" required value="<?= htmlspecialchars($res['matricula']) ?>"></label>
            <label>Série:
              <select name="serie_id" required>
                <option value="">-- Escolha --</option>
                <?php while($s = $series->fetch_assoc()): ?>
                  <option value="<?= $s['id'] ?>" <?= $s['id']==$res['serie_id']?'selected':'' ?>><?= htmlspecialchars($s['nome']) ?></option>
                <?php endwhile; ?>
              </select>
            </label>
            <label>Responsável:
              <select name="responsavel_id" required>
                <option value="">-- Escolha --</option>
                <?php while($r = $resp->fetch_assoc()): ?>
                  <option value="<?= $r['id'] ?>" <?= $r['id']==$res['responsavel_id']?'selected':'' ?>><?= htmlspecialchars($r['nome']) ?></option>
                <?php endwhile; ?>
              </select>
            </label>
            <div><button type="submit">Atualizar</button></div>
          </form>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
      <script src="assets/app.js"></script>
    </body>
    </html>
