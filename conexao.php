<?php
    $server = 'localhost';
    $user = 'root';
    $pass = 'H98xH11';
    $db = 'maquinas';

    $conn = new mysqli($server, $user, $pass, $db);

    if($conn->connect_error){
        die("Falha ao conectar " . $conn->connect_error);
    }
?>