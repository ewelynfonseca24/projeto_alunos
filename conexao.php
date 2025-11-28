<?php
  
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'cadastro_alunos';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die('Conexão falhou: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    ?>