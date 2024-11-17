<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar'])) {
    $senhaCorreta = '1234'; 

    if (isset($_POST['senha']) && $_POST['senha'] == $senhaCorreta) {
        $rastreabilidade = $_POST['edicao'];
        $equipamento = $_POST['opcao'];

        $deletar = "DELETE FROM $equipamento WHERE cod = ?";
        $stmt = $conn->prepare($deletar);

        if ($stmt) {
            $stmt->bind_param('i', $rastreabilidade);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "
                <script> alert('Deletado com sucesso!') </script>
                <form id='select' action='operation.php' method='POST'>
                    <input type='hidden' name='btnAcess' value='" . $equipamento . "'>
                </form>
                ";

                echo "
                <script>
                    document.querySelector('#select').submit(); // Envia o formulário de redirecionamento
                </script>
                "; 
                exit();
            } else {
                echo "Nenhuma alteração realizada ou erro na consulta.<br>";
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    }else {
        $rastreabilidade = $_GET['edicao'];
        $equipamento = $_GET['opcao'];
        echo "<script> alert('Senha Incorreta!') </script>";
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link href='./bootstrap-5.3.3-dist/css/bootstrap.min.css' rel='stylesheet'>
            <title>Document</title>
        </head>
        <body class='vh-100 d-flex justify-content-center align-items-center'>
        <div class='d-flex justify-content-center flex-column align-items-center'>
            <form action='' method='POST'>
                <h1 class=''>Digite a senha: </h1>
                <div class='d-flex justify-content-center flex-column align-items-center'>
                    <input class='form-control focus-ring' type='password' name='senha' required'>
                    <input type='hidden' name='edicao' value='$rastreabilidade'>
                    <input type='hidden' name='opcao' value='$equipamento'><br>
                    <button class='btn btn-dark' type='submit' name='confirmar' value='1'>Confirmar</button>
                </div>
            </form>
        </div>
        </body>
        </html>
        ";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $rastreabilidade = $_GET['edicao'];
    $equipamento = $_GET['opcao'];
    
    if(isset($_GET['editor']) && $_GET['editor'] == 'check'){
        $codigo = $_GET['codigo'];
        $nome = $_GET['nome'];
        $marca = $_GET['marca'];
        $estoqueMin = $_GET['estoque_min'];
    
        $modificar = "UPDATE $equipamento SET 
                        cod = ?, 
                        nome = ?, 
                        marca = ?, 
                        estq_min = ? 
                      WHERE cod = ?";
        $stmt = $conn->prepare($modificar);
    
        if ($stmt) {
            $stmt->bind_param('issii', $codigo, $nome, $marca, $estoqueMin, $rastreabilidade);
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                header("Location: historico.php?edicao=" . urlencode($codigo) . "&opcao=" . urlencode($equipamento));
                exit(); 
            } else {
                echo "Nenhuma alteração realizada ou erro na consulta.<br>";
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else if (isset($_GET['editor']) && $_GET['editor'] == 'trash'){
        echo "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link href='./bootstrap-5.3.3-dist/css/bootstrap.min.css' rel='stylesheet'>
            <title>Document</title>
        </head>
        <body class='vh-100 d-flex justify-content-center align-items-center'>
        <div class='d-flex justify-content-center flex-column align-items-center'>
            <form action='' method='POST'>
                <h1 class=''>Digite a senha: </h1>
                <div class='d-flex justify-content-center flex-column align-items-center'>
                    <input class='form-control' type='password' name='senha' required>
                    <input type='hidden' name='edicao' value='$rastreabilidade'>
                    <input type='hidden' name='opcao' value='$equipamento'><br>
                    <button class='btn btn-dark' type='submit' name='confirmar' value='1'>Confirmar</button>
                </div>
            </form>
        </div>
        </body>
        </html>
        ";
    }
}
