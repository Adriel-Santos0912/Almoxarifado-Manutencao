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
        <a href="index.html"><button class='btn btn-info btn-sm'>Voltar</button></a>
    </div>
    <header class="mb-5 d-flex">
        <?php
            if($item == 'ds2'){
                $headDs2 = 'active';
                $headK18 = $headRes = "";
            } else if ($item == 'k18') {
                $headK18 = 'active';
                $headDs2 = $headRes = "";
            } else if ($item == 'resistencia') {
                $headRes = 'active';
                $headDs2 = $headK18 = "";
            }
            echo " 
                <form action='operation.php' method='POST'>
                    <ul class='nav nav-tabs d-flex justify-content-center'>
                        <li class='nav-item'>
                            <input class='nav-link " . $headDs2 . " text-dark' type='submit' value='DS-2' name='btn1'
                            alt='botão de Acessar planilha da máquina K-18'>
                        </li>
                        <li class='nav-item'>
                            <input class='nav-link " . $headK18 . "  text-dark' type='submit' value='K-18' name='btn2'
                            alt='botão de Acessar planilha da máquina K-18'>
                        </li>
                        <li class='nav-item'>
                            <input class='nav-link " . $headRes . "  text-dark' type='submit' value='Resistência' name='btn3'
                            alt='botão de Acessar planilha da Resistência'>
                        </li>  
                    </il>      
                </form>         
                ";
            $conn->close();
        ?>
    </header>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome da Peça</th>
                    <th scope="col">Marca da Peça</th>
                    <?php
                        if($item == 'resistencia'){
                            echo "<th scope='col'>Tipo</th>"; 
                            echo "<th scope='col'>Medidas</th>";  
                        }
                    ?>
                    <th scope="col">Estoque min</th>
                    <th scope="col">Saldo</th>
                    <th scope="col" id='colsub' class="text-center px-2">Subtrair</th>
                </tr>
            </thead>
            <tbody>              
            <?php
                include('reconhecer.php');             
                if($item == 'ds2' || $item == 'k18'){
                    $insSQL = "SELECT cod, nome, marca, estq_min, saldo FROM $item";
                } else if($item == 'resistencia') {
                    $insSQL = "SELECT cod, nome, tipo, marca, estq_min, medidas, saldo FROM $item";
                }
                $res = $conn->query($insSQL);
            
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        echo "<tr>";
                        if($item == 'ds2' || $item == 'k18'){
                            echo "<td>" . $row['cod'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            echo "<td>" . $row['estq_min'] . "</td>";
                            echo "<td>" . $row['saldo'] . "</td>";
                            echo "
                                <td>
                                    <div class='d-flex justify-content-center'>
                                        <button type='button' class='btn btn-danger' style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .75rem;'> - 1 </button>
                                    </div>
                                </td>";
                        }
                        if($item == 'resistencia'){
                            echo "<td>" . sprintf('%03d', $row['cod']) . "</td>";
                            echo "<td class='linhaNome'>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['marca'] . "</td>";
                            echo "<td>" . $row['tipo'] . "</td>";
                            echo "<td>" . $row['medidas'] ."</td>";
                            echo "<td>" . $row['estq_min'] . "</td>";
                            echo "<td>" . $row['saldo'] . "</td>";
                            echo "
                                <td>
                                    <div class='d-flex justify-content-center'>
                                        <button type='button' class='btn btn-danger' style='--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .75rem;'> - 1 </button>
                                    </div>
                                </td>";
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
</body>
</html>


