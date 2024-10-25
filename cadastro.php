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
            <?php
                echo "<h1 class='text-white text-center'>Cadastro " . $selected . "</h1>";
            ?>
        </div>
    </header>
    <main class="d-flex justify-content-center">
        <form class="container" method="POST" action="acao.php">
        <div class="row">
                <!-- o Código da peça pode incluir Numeros -->
                <div class="col-12 col-xl-6">
                    <label for="codigo">Código:</label><br>
                    <input class=" form-control form-control-lg" type="text" name="codigo" placeholder="Código da peça"><br><br>
                </div>

                <div class="col-12 col-xl-6">
                    <label for="marca">Marca da Peça:</label><br>
                    <input class=" form-control form-control-lg" type="text" name="marca" placeholder="Insira a marca da peça aqui"><br><br>
                </div>

                <div class="col-12">
                    <label for="peca">Nome da Peça:</label><br>
                    <input class="form-control form-control-lg" type="text" name="peca" placeholder="Insira o nome da peça aqui"><br><br> 
                </div>

                <!-- if (cadastro === Resistencia){aparecer dropdown button}; -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tipo da Resistência
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a type="button" class="dropdown-item" href="#">X</a>
                        <a type="button" class="dropdown-item" href="#">ø</a>
                    </div>
                </div>
                <br><br><br>
                
                <div class="col-12 col-xl-6">
                    <label for="medida">Medidas:</label><br>
                    <input class=" form-control form-control-lg" type="text" name="medida" placeholder="Ex: 2x15cm 1x30cm"><br><br>
                </div>
               
                <div class="col-12 col-xl-6">
                    <label for="estoque">Estoque Minimo:</label><br>
                    <input class="form-control form-control-lg" type="number" name="estoque" placeholder="Minimo de estoque"><br><br>
                </div>

                <div class="col-12 col-xl-6">
                    <label for="saldo">Saldo da Peça:</label><br>
                    <input class="form-control form-control-lg" type="number" name="saldo" placeholder="Quantidade no estoque"><br><br>
                </div>                
            <?php
                include('reconhecer.php');

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if($item == 'ds2'){
                        echo "<input type='hidden' value='ds2' name='maq'>";
                    } else if($item == 'k18') {
                        echo "<input type='hidden' value='k18' name='maq'>";
                    } else if($item == 'resistencia') {
                        echo "<input type='hidden' value='resistencia' name='maq'>";
                    } else {
                        echo "ERRO! Valor invalido";
                    }
                    
                }
            ?>
            <div class='d-flex justify-content-center' id="enviar">
                <input class="btn btn-info py-2 ps-5 pe-5" type="submit" value="Enviar">
            </div>
            </div>
        </form>
    </main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
