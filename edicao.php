<?php 
include('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $codigo = $_GET['edicao'];
    $item = $_GET['opcao'];
    $dataSQL = "SELECT cod, nome, marca, estq_min, saldo from $item";
    $res = $conn->query($dataSQL);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo "<td>" . $row['cod'] . "</td> | ";
            echo "<td>" . $row['nome'] . "</td> | ";
            echo "<td>" . $row['marca'] . "</td> | ";
            echo "<td>" . $row['estq_min'] . "</td> | ";
            echo "<td>" . $row['saldo'] . "</td><br>";
        }
    }
}
