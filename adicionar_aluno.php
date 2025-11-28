<?php
    require 'conexao.php';
   
    $resp = $conn->query("SELECT id, nome FROM responsavel ORDER BY nome");
    $series = $conn->query("SELECT id, nome FROM serie ORDER BY nome");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $data = $_POST['data_nascimento']?:NULL;
        $matricula = $_POST['matricula'];
        $responsavel_id = $_POST['responsavel_id']?:NULL;
        $serie_id = $_POST['serie_id']?:NULL;

        $stmt = $conn->prepare('INSERT INTO aluno (nome, data_nascimento, matricula, responsavel_id, serie_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $nome, $data, $matricula, $responsavel_id, $serie_id);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Adicionar Aluno</title>
      <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
      <header><h1>Adicionar Aluno</h1><nav><a href="index.php">Voltar</a></nav></header>
      <main>
        <section class="card">
          <form id="alunoForm" method="post" action="">
            <label>Nome:<input type="text" name="nome" required></label>
            <label>Data de Nascimento:<input type="date" name="data_nascimento"></label>
            <label>Matrícula:<input type="text" name="matricula" required></label>
            <label>Série:
              <select name="serie_id" required>
                <option value="">-- Escolha --</option>
                <?php while($s = $series->fetch_assoc()): ?>
                  <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nome']) ?></option>
                <?php endwhile; ?>
              </select>
            </label>
            <label>Responsável:
              <select name="responsavel_id" required>
                <option value="">-- Escolha --</option>
                <?php while($r = $resp->fetch_assoc()): ?>
                  <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['nome']) ?></option>
                <?php endwhile; ?>
              </select>
            </label>
            <div><button type="submit">Salvar</button></div>
          </form>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
      <script src="assets/app.js"></script>
    </body>
    </html>
