<?php
    include('conexao.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $verif= 0;
        foreach($_POST as $key => $value){
            if(strpos($key,'btn') === 0){
                $btn = "acessar";
                $item = ($key == 'btn1') ? 'ds2' :
                        (($key == 'btn2') ? 'k18' :
                        (($key == 'btn3') ? 'resistencia' : 'Undefined'));
                break;
            }
            if(strpos($key,'cadastro') === 0){
                $btn = "cadastrar";
                $item = ($key == 'cadastro1') ? 'ds2' :
                        (($key == 'cadastro2') ? 'k18' :
                        (($key == 'cadastro3') ? 'resistencia' : 'Undefined'));
                break;
            }
        }

        $selected = ($item == 'ds2') ? 'DS-2' :
                    (($item == 'k18') ? 'K-18' :
                    (($item == 'resistencia') ? 'Resistencia' : 'Undefined'));
    }
