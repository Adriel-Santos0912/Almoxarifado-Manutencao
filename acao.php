<?php
    include('conexao.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $item = $_POST['maq'];
        $namePeca = $_POST['peca'];
        $saldo = $_POST['saldo'];
        $marca = $_POST['marca'];
        $estqMin = $_POST['estoque'];

        if(isset($_POST["data"])){
            $exData = $_POST["data"];
            include("exibir.php");
        }else{
            $stmt = $conn->prepare("INSERT INTO $item(nome, marca, estq_min, saldo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $namePeca, $marca , $estqMin, $saldo);
            if($stmt->execute()){
                echo '<h3>Cadastrado</h3>';
                echo 'Peça: ' . $namePeca . "<br>";
                echo 'Marca: ' . $marca . "<br>";
                echo 'Estoque Minimo: ' . $estqMin . "<br>";
                echo 'Quantidade: ' . $saldo . "<br>";
                echo '<p><a href="HTML/form' . $item . '.html">Cadastrar outro item</a></p>';
                echo '<p><a href="index.html">Voltar ao início</a></p>';
            }else {
                echo "ERRO: " . $stmt->error;
            }
            $stmt-> close();
            $conn->close();
        }
    }
?>