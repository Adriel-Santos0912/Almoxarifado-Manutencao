<?php
    include('conexao.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $item = $_POST['item'];
        $componente = $_POST["comp"];
        $qntd = $_POST["qntd"];

        if(isset($_POST["data"])){
            $exData = $_POST["data"];
            include("exibir.php");
        }else{
            $stmt = $conn->prepare("INSERT INTO $item(nome, qntd) VALUES (?, ?)");
            $stmt->bind_param("si", $componente, $qntd);
            if($stmt->execute()){
                echo '<h3>Cadastrado</h3>';
                echo 'Item: ' . $componente . "<br>";
                echo 'Quantidade: ' . $qntd . "<br>";
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