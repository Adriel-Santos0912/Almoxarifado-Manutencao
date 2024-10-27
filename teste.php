<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Almoxarifado-Manutencao/CSS/ItemCadastrado.css">
    <link href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" defer></script>
    <title>Item Cadastrado!</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-5 text-center">Item cadastrado com <span class="text-success">Sucesso</span></h1>
            </div>
            <div class="col-12 d-flex justify-content-center pt-4">
            <div class="box shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <?php
                    $namePeca = 'pedal';
                    $marca = 'kotlin';
                    $tipoRes = 'x';
                    $medidas = '2x45 1x90';
                    $estqMin = '5';
                    $saldo = '10';
                    $item = 'peça';

                    echo '<script>//alert("Item cadastrado com Sucesso!")</script>';
                    echo '
                            <h3 class="text-center border-bottom">Descrição do item</h3>
                            <span class="">Peça: ' . $namePeca . '</span><br>
                            Marca: ' . $marca . '<br>
                        ';
                        // if($item == 'resistencia'){
                            echo 'Tipo Resistência: ' . $tipoRes . '<br>';
                            echo 'Medidas: ' . $medidas . '<br>';
                        // }
                        echo 'Estoque Minimo: ' . $estqMin . '<br>';
                        echo 'Quantidade: ' . $saldo . '<br>';

                        //Botoes
                        echo "<p class='pt-3'><a class='d-flex justify-content-center btn btn-warning' href='HTML/form' . $item . '.html'>Cadastrar outro item</a></p>";
                        echo "<p><a class='d-flex justify-content-center btn btn-info' href='index.html'>Voltar ao início</a></p>";
                    // }else {
                    //     echo "ERRO: " . $stmt->error;
                ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
