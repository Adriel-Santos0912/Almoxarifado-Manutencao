<?php 
include('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $codigo = $_GET['edicao'];
    $item = $_GET['opcao'];

    if($item == 'resistencia'){
        $dataSQL2 = "SELECT cod, nome, marca, medidas, tipo, estq_min, saldo from $item WHERE cod= '$codigo'";
    } else {
        $dataSQL2 = "SELECT cod, nome, marca, estq_min, saldo from $item WHERE cod= '$codigo'";
    }

    $res2 = $conn->query($dataSQL2);
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
    <header class="bg-dark d-flex justify-content-center align-items-center">
        <h1 class="text-white">Histórico de mudanças</h1>
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
                <th scope="col">Estoque mínimo</th>
                <th scope="col">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($res2->num_rows > 0){
                    while($row = $res2->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['cod'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        if($item == 'resistencia'){
                        echo "<td>" . $row['tipo'] . "</td>";
                        echo "<td>" . $row['medidas'] ."</td>";
                        }
                        echo "<td>" . $row['estq_min'] . "</td>";
                        echo "<td>" . $row['saldo'] . "</td><br>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
        </table>
        <section>
            <h3>Histórico</h3>
            <hr>
                <?php
                $ultima_modificacao = NULL;
                $dataHoraLog = "SELECT saldo_final, alteracao, data_modificacao
                                FROM log AS l1
                                WHERE l1.data_modificacao = (
                                    SELECT MAX(l2.data_modificacao)
                                    FROM log AS l2
                                    WHERE DATE(l2.data_modificacao) = DATE(l1.data_modificacao)
                                ) ORDER BY DATE(l1.data_modificacao) ASC";
                $resDataHora = $conn->query($dataHoraLog);

                $datasLog = "SELECT DATE(data_modificacao) AS data
                            FROM log
                            GROUP BY DATE(data_modificacao)";
                $resData = $conn->query($datasLog);

                if($resData->num_rows > 0){
                    while($row = $resData->fetch_assoc()){
                        $dataTransformada = strtotime($row['data']); 
                        $apenasData = date('Y-m-d', $dataTransformada);
                        $logSQL = "SELECT cod, saldo_final, alteracao, data_modificacao from log 
                                    WHERE DATE(data_modificacao) = '$row[data]'";
                        $resLog = $conn->query($logSQL);
                        $dataBR = date('d/m/Y', $dataTransformada);
                        
                        echo "<p>". $dataBR ."</p>";

                        if($resDataHora->num_rows > 0){
                            if($row = $resDataHora->fetch_assoc()){
                                $ultima_modificacao = $row['saldo_final'];
                                echo "<p>Saldo Final do dia: ". $ultima_modificacao ."</p>";
                            }
                        }
                        if($resLog->num_rows > 0){
                            while($row = $resLog->fetch_assoc()){
                                echo "<p>". $row['alteracao'] ."</p>";
                                // echo "<p>Saldo Final: ". $row['saldo_final'] ."</p>";
                            }
                        }
                        echo "<hr>";
                    }
                }
                ?>

        </section>
</body>
</html>