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
            <h3>Histórico</h3>
            <hr>
                <?php
                // PEGANDO DATA CRAVADA
                $selectData = "SELECT cod, equipamento, saldo_final, data_modificacao, DATE(data_modificacao) AS dataa 
                            FROM log AS ref
                            WHERE cod = 15 AND equipamento = 'ds2' AND ref.data_modificacao = (
                            SELECT MAX(data_modificacao)
                            from log AS comp
                            WHERE DATE(comp.data_modificacao) = DATE(ref.data_modificacao)
                            ) GROUP BY cod, equipamento, saldo_final, data_modificacao, DATE(data_modificacao)
                            ORDER BY DATE(data_modificacao) DESC";
                $resData = $conn->query($selectData);
                
                if($resData->num_rows > 0){
                    while($row = $resData->fetch_assoc()){
                        $dataAtual = $row['dataa'];
                        // IMPRIMINDO DATA E SALDO FINAL --
                        echo "<div>";
                        echo"<h5>" . $row['dataa'] . "</h5>";
                        echo "<p>Saldo final do dia: " . $row['saldo_final'] . "</p>";

                        // ALTERACOES, HORAS E SALDO FINAL --
                        $selectLog = "SELECT cod, saldo_final, alteracao, equipamento, data_modificacao, DATE(data_modificacao) AS apenas_data
                        FROM log
                        WHERE cod = 15
                        GROUP BY cod, saldo_final, alteracao, equipamento, data_modificacao, DATE(data_modificacao)
                        ORDER BY data_modificacao DESC";
                        $resLog = $conn->query($selectLog);
                        
                        if($resLog->num_rows > 0){
                            while($row = $resLog->fetch_assoc()){
                                if($row['apenas_data'] == $dataAtual){
                                    // FORMATANDO --
                                    $dataTransformada = strtotime($row['data_modificacao']);
                                    $hora = date('H:i', $dataTransformada);
                                    $num = (int) $row['alteracao'];
                                    // ESTRUTURA --
                                    echo "<p>";
                                    if($num > 0){
                                        echo "[".$hora."] Adicionado: " . $row['alteracao'];
                                    } else {
                                        echo "[".$hora."] Removido: " . $row['alteracao'];
                                    }
                                    echo "</p>";
                                    
                                }
                            }   
                        }
                        echo "</div>";
                        echo "<hr>";
                    }
                }
                ?>
        </section>
</body>
</html>