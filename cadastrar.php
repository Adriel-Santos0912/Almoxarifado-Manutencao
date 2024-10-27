<?php
    include('conexao.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $item = $_POST['maq'];
        $codigo = $_POST['codigo'];
        $namePeca = $_POST['peca'];
        $saldo = $_POST['saldo'];
        $marca = $_POST['marca'];
        $estqMin = $_POST['estoque'];
        
        if(isset($_POST['medidas'])){
            $medidas = $_POST['medidas'];
            $tipoRes = $_POST['tipo'];
        }

        if($item == 'resistencia') {
            $stmt = $conn->prepare("INSERT INTO $item(cod, nome, marca, tipo, medidas, estq_min, saldo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssii", $codigo, $namePeca, $marca, $tipoRes, $medidas, $estqMin, $saldo);
        } else {
            $stmt = $conn->prepare("INSERT INTO $item(cod, nome, marca, estq_min, saldo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issii", $codigo, $namePeca, $marca , $estqMin, $saldo);
        }
        
        if($stmt->execute()){
            echo '<h3>Cadastrado</h3>';
            echo 'Peça: ' . $namePeca . '<br>';
            echo 'Marca: ' . $marca . '<br>';
            if($item == 'resistencia'){
                echo 'Tipo Resistência: ' . $tipoRes . '<br>';
                echo 'Medidas: ' . $medidas . '<br>';
            }
            echo 'Estoque Minimo: ' . $estqMin . '<br>';
            echo 'Quantidade: ' . $saldo . '<br>';
            echo "<p><a href='HTML/form' . $item . '.html'>Cadastrar outro item</a></p>";
            echo "<p><a href='index.html'>Voltar ao início</a></p>";
        }else {
            echo "ERRO: " . $stmt->error;
        }
        $stmt-> close();
        $conn->close();
    }
?>