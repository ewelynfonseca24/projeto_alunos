<?php
    require 'conexao.php';
   
    $c1 = $conn->query('SELECT COUNT(*) as c FROM aluno')->fetch_assoc()['c'];
    $c2 = $conn->query('SELECT COUNT(*) as c FROM responsavel')->fetch_assoc()['c'];
    $c3 = $conn->query('SELECT COUNT(*) as c FROM serie')->fetch_assoc()['c'];
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Administração</title><link rel="stylesheet" href="assets/style.css"></head>
    <body>
      <header><h1>Painel Administrativo</h1><nav><a href="index.php">Alunos</a> | <a href="gerenciar_responsaveis.php">Responsáveis</a> | <a href="gerenciar_series.php">Séries</a></nav></header>
      <main>
        <section class="card">
          <h2>Resumo</h2>
          <ul>
            <li>Total de Alunos: <?= $c1 ?></li>
            <li>Total de Responsáveis: <?= $c2 ?></li>
            <li>Total de Séries: <?= $c3 ?></li>
          </ul>
        </section>
      </main>
      <footer>Desenvolvido Por Ewelyn Fonseca e Gerrard Maciel.</footer>
    </body>
    </html>
