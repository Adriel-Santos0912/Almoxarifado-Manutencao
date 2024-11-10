<?php 
include('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $codigo = $_GET['edicao'];
    $item = $_GET['opcao'];
    if($item == 'resistencia'){
        $dataSQL = "SELECT cod, nome, marca, medidas, tipo, saldo_final, alteracao from log WHERE cod= '$codigo' AND equipamento = '$item'";
    } else {
        $dataSQL = "SELECT cod, nome, marca, saldo_final, alteracao from log WHERE cod= '$codigo' AND equipamento = '$item'";
    }
    $res = $conn->query($dataSQL);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" defer></script>
    <link rel="stylesheet" href="CSS/styleForm.css">
    <title>Cadastrar Item</title>
</head>
<body>
    <div id="floatbtn" class='float-start p-1'>
        <a href="index.html"><button class='btn btn-info btn-sm p-1'>Voltar</button></a>
    </div>
    <header class="bg-dark">

    </header>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome da Peça</th>
                    <th scope="col">Marca da Peça</th>
                    <?php
                        if($item == 'resistencia'){
                            echo "<th scope='col'>Tipo</th>"; 
                            echo "<th scope='col'>Medidas</th>";  
                        }
                    ?>
                    <th scope="col">Alteração</th>
                    <th scope="col">Saldo Final</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $row['cod'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            if($item == 'resistencia'){
                            echo "<td>" . $row['tipo'] . "</td>";
                            echo "<td>" . $row['medidas'] ."</td>";
                            }
                            echo "<td>" . $row['alteracao'] . "</td>";
                            echo "<td>" . $row['saldo_final'] . "</td><br>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
</body>
</html>