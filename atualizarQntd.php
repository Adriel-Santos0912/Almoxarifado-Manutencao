<?php
include('conexao.php');

$bdSelect = $_POST['bd'];
$saldo = $_POST['vfSaldo'];

if(isset($_POST['decrement'])){
    $qntdIncr = $_POST['qntdAlter'];
    if($saldo > 0 && $qntdIncr <= $saldo){
        $operacao = $_POST['decrement'];
        $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo - $qntdIncr WHERE cod = ?");
        $stmt->bind_param("i", $operacao);
        $stmt->execute(); 
    } else {
        echo "<script> alert('SALDO ZERADO OU INSUFICIENTE!" . '\n' . "Operação não realizada') </script>";
    }
} else if(isset($_POST['increment'])) {
    $operacao = $_POST['increment'];
    $qntdIncr = $_POST['qntdAlter'];
    $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo + $qntdIncr WHERE cod = ?");   
    $stmt->bind_param("i", $operacao);
    $stmt->execute(); 
}

echo "
<form id='select' action='operation.php' method='POST'>
    <input type='hidden' name='btnAcess' value='" . $bdSelect . "'>
</form>
";

echo "
<script>
    document.querySelector('#select').submit()
</script>
"; 


