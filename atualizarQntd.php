<?php
    include('conexao.php');

    $bdSelect = $_POST['bd'];
    $saldo = $_POST['vfSaldo'];

    if(isset($_POST['decrement'])){
        if($saldo > 0){
            $operacao = $_POST['decrement'];
            $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo - 1 WHERE cod = ?");
            $stmt->bind_param("i", $operacao);
            $stmt->execute();   
        } else {
            echo "<script> alert('SALDO ZERADO!" . '\n' . "Operação não realizada') </script>";
        }
    } else if(isset($_POST['increment'])) {
        $operacao = $_POST['increment'];
        $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo + 1 WHERE cod = ?");  
        $stmt->bind_param("i", $operacao);
        $stmt->execute();   
    }

    $item = ($bdSelect == 'ds2') ? 'btn1' :
    (($bdSelect == 'k18') ? 'btn2' :
    (($bdSelect == 'resistencia') ? 'btn3' : 'Undefined'));

    echo "
    <form id='select' action='operation.php' method='POST'>
        <input type='hidden' name='" . $item . "'>
    </form>
    ";

    echo "
    <script>
        document.querySelector('#select').submit()
    </script>
    "; 


