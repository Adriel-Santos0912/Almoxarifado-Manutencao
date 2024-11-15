<?php 
include('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $codigo = $_GET['edicao'];
    $equipamento = $_GET['opcao'];

    // SELECT que pegará todos os dados da tabela do equipamento específico no SQL  -- Tabela no topo da página
    if($equipamento == 'resistencia'){
        $espelho = "SELECT cod, nome, marca, medidas, tipo, estq_min, saldo from $equipamento WHERE cod= '$codigo'";
    } else {
        $espelho = "SELECT cod, nome, marca, estq_min, saldo from $equipamento WHERE cod= '$codigo'";
    }
    $resEspelho = $conn->query($espelho);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" defer></script>
    <link rel="stylesheet" href="CSS/styleForm.css">
    <title>Cadastrar Item</title>
</head>
<body>
    <div id="floatbtn" class='float-start p-2'>
        <a href="index.html"><button class='btn btn-info btn-sm p-2'>Voltar</button></a>
    </div>   
    <header class="bg-dark d-flex justify-content-center align-items-center">
        <h1 class="text-white">Histórico de Movimentações</h1>
    </header>
    <main>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nome da Peça</th>
                <th scope="col">Marca da Peça</th>
                <?php
                    if($equipamento == 'resistencia'){
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
                if($resEspelho->num_rows > 0){
                    while($row = $resEspelho->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['cod'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        if($equipamento == 'resistencia'){
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
            <h2>Histórico</h2>
            <hr>
            <?php
            // PEGANDO TODAS AS MODIFICAÇÕES
            $selectData = "SELECT cod, equipamento, saldo_comeco, saldo_final, alteracao, data_modificacao, DATE(data_modificacao) AS apenas_data
                        FROM log
                        WHERE cod = ? AND equipamento = ?
                        ORDER BY data_modificacao DESC";
            $stmt = $conn->prepare($selectData);
            $stmt->bind_param('ss', $codigo, $equipamento);
            $stmt->execute();
            $resData = $stmt->get_result();

            $apenas_datatual = '';
            if($resData->num_rows > 0){
                while($row = $resData->fetch_assoc()){
                    if($apenas_datatual != $row['apenas_data']){
                        if($apenas_datatual != ''){
                            echo "</ul>";
                            echo "</div><hr>";
                        }
                        $apenas_datatual = $row['apenas_data'];
                        $dataBD = strtotime($row['apenas_data']);
                        $dataBR = date('d/m/Y', $dataBD);
                        echo "<div>";
                        echo "<h4>" . $dataBR . "</h4>";
                        
                        echo "<p class='saldoFinal text-light bg-dark'>Saldo final do dia: " . $row['saldo_final'] . "</p>";
                        echo "<ul class='historic_list'>";
                    }
                    // FORMATANDO
                    $dataTransformada = strtotime($row['data_modificacao']);
                    $hora = date('H:i', $dataTransformada);
                    $num = (int) $row['alteracao'];
                    
                    // ESTRUTURA
                    if($num > 0){
                        echo "<li>";
                        echo "Adicionado: " . $row['alteracao'];
                        echo "<span><i class='bi bi-clock'></i> " . $hora ."</span>";
                        echo "</li>";
                    } else{
                        echo "<li>";
                        echo "Retirado: " . $row['alteracao'];
                        echo "<span><i class='bi bi-clock'></i> " . $hora ."</span>";
                        echo "</li>";
                    }
                    $saldoComeco = $row['saldo_comeco'];
                }
                echo "</ul>";
                echo "<p class='saldoFinal text-light bg-dark mt-3 py-2'>Saldo inicial: " . $saldoComeco . "</p>";
                echo "</div>";
                echo "<hr>";
            } else {
                echo "<p class='lead text-center'>Sem Alterações</p>";
            }
            ?>
        </section>
</body>
</html>