<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/stylecadastro.css">
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Peças</title>
</head>
<body class="bg-light">
    <header class="mb-5 bg-dark d-flex">
        <div class="d-inline p-2">
            <a class="btn btn-info" href="index.html">Voltar</a>
        </div>
        <div id="h1" class="d-flex justify-content-center">
            <h1 class="text-white text-center">Almoxarifado Manutenção</h1>
        </div>
    </header>
    <main class="d-flex justify-content-center">
        <form class="container" method="POST" action="../acao.php">
            <?php
                include('reconhecer.php');

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($item == 'ds2'){
                            echo "Cadastro DS2";
                        } else if($item == 'k18'){
                            echo "Cadastro K18";
                        } else if($item == 'resistencia') {
                            echo "Cadastro Resistencias";
                        } else {
                            echo "Nenhuma";
                        }
                }
            ?>
        </form>
    </main>
<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
