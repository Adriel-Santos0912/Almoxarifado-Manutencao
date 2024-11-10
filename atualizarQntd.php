<?php
include('conexao.php');

$bdSelect = $_POST['bd'];
$saldo = $_POST['vfSaldo'];
$qntdIncr = $_POST['qntdAlter'];

if(isset($_POST['increment'])){
    $codigo = $_POST['increment'];
} else {
    $codigo = $_POST['decrement'];
}

if($bdSelect == 'resistencia'){
    $insSQL = "SELECT cod, nome, marca, medidas, saldo, tipo FROM $bdSelect WHERE cod = '$codigo'";
} else {
    $insSQL = "SELECT cod, nome, marca, saldo FROM $bdSelect WHERE cod = '$codigo'";
}

$res = $conn->query($insSQL);

if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        $namePeca = $row['nome'];
        $marca = $row['marca'];
        $saldoFinal = $row['saldo'];
        if($bdSelect == 'resistencia'){
            $medidas = $row['medidas'];
            $tipo = $row['tipo'];
        }
    }
}

if(isset($_POST['decrement'])){
    if($saldo > 0 && $qntdIncr <= $saldo){
        $saldoFinal -= $qntdIncr;
        $valAlterado = "-" . $qntdIncr;

        $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo - $qntdIncr WHERE cod = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute(); 
    } else {
        echo "<script> alert('SALDO ZERADO OU INSUFICIENTE!" . '\n' . "Operação não realizada') </script>";
    }
} else if(isset($_POST['increment'])) {
        $saldoFinal += $qntdIncr;
        $valAlterado = "+". $qntdIncr;

        $stmt = $conn->prepare("UPDATE $bdSelect SET saldo = saldo + $qntdIncr WHERE cod = ?");  
        $stmt->bind_param("i", $codigo);
        $stmt->execute(); 
}

if($bdSelect == 'resistencia'){
    $stmtLog = $conn->prepare("INSERT INTO log(cod, nome, marca, medidas, tipo, alteracao, saldo_final, equipamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtLog->bind_param("isssssis", $codigo, $namePeca, $marca, $medidas, $tipo, $valAlterado, $saldoFinal, $bdSelect);
    $stmtLog->execute();
} else {
    $stmtLog = $conn->prepare("INSERT INTO log(cod, nome, marca, medidas, tipo, alteracao, saldo_final, equipamento) VALUES (?, ?, ?, NULL, NULL, ?, ?, ?)");
    $stmtLog->bind_param("isssis", $codigo, $namePeca, $marca, $valAlterado, $saldoFinal, $bdSelect);
    $stmtLog->execute();
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


