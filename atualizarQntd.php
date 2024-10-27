<?php
    include('conexao.php');

    $id = $_POST['idS'];
    $bdSelect = $_POST['bd'];

    $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo - 1 WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();
    echo "Saldo atualizado com sucesso!";
