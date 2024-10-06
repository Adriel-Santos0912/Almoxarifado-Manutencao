<?php
    include('conexao.php');

    $insSQL = "SELECT nome, qntd FROM ds2";
    $res = $conn->query($insSQL);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo "Nome: " . $row['nome'] . "<br>Quantidade: " . $row['qntd'] . "<br>";
        }
    }else {
        echo "0 Results!";
        $voltar = $_SERVER['HTTP_REFERER'];
        echo "<a href= . $voltar>Voltar</a>";
    }

    $conn->close();
?>