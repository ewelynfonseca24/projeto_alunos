<?php
    require 'conexao.php';
    $id = $_GET['id'] ?? null;
    if ($id) {
        $stmt = $conn->prepare('DELETE FROM aluno WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
    header('Location: index.php');
    exit;
    ?>