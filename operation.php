<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include('reconhecer.php');
        if($btn == "acessar"){
            include('dados.php');
        } else if ($btn == "cadastrar") {
            include('cadastro.php');
        } else {
            echo "Invalido";
        }
    }