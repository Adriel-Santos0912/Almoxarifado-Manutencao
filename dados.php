<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleForm.css">
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Item</title>
</head>
<body>
    <header class="mb-5 bg-dark d-flex">
        <div class="d-inline p-2">
            <a class="btn btn-info" href="index.html">Voltar</a>
        </div>
        <div id="h1" class="d-flex justify-content-center">
            <?php
                echo "<h1 class='text-white text-center'>Peças " . $selected . "</h1>";
                $conn->close();
            ?>
        </div>
    </header>

    <main>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome da Peça</th>
                    <th scope="col">Marca da Peça</th>
                    <th scope="col">Estoque min</th>
                    <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>              
            <?php
                include('reconhecer.php');             
                if($item == 'ds2' || $item == 'k18'){
                    $insSQL = "SELECT id, nome, marca, estq_min, saldo FROM $item";
                } else if($item == 'resistencia') {
                    $insSQL = "SELECT id, nome, marca, estq_min, saldo FROM $item";
                }
                
                $res = $conn->query($insSQL);
            
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        echo "<tr>";
                        if($item == 'ds2' || $item == 'k18'){
                            echo "<td>" . sprintf('%03d', $row['id']) . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            echo "<td>" . $row['estq_min'] . "</td>";
                            echo "<td>" . $row['saldo'] . 
                            "<form action='atualizar.php' method='post'>
                                <input type='hidden' name='idS' value='" . $row['id'] . "'>
                                <button class='btnSomar' type='submit'>+1</button>
                                <input type='hidden' value='" . $item . "' name= 'bd'>
                            </form>" . "</td>";
                        }
                        if($item == 'resistencia'){
                            echo "<td>" . sprintf('%03d', $row['id']) . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            echo "<td>" . $row['estq_min'] . "</td>";
                            echo "<td>" . $row['saldo'] . 
                            "<form action='atualizar.php' method='post'>
                                <input type='hidden' name='idS' value='" . $row['id'] . "'>
                                <button class='btnSomar' type='submit'>+1</button>
                                <input type='hidden' value='" . $item . "' name= 'bd'>
                            </form>" . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table></main>";
                }else {
                    echo "0 Results!";
                    $voltar = $_SERVER['HTTP_REFERER'];
                    echo "<a href= . $voltar>Voltar</a>";
                }

                $conn->close();
            ?>
        </table>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>


