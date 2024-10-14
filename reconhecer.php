<?php
    include('conexao.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        foreach($_POST as $key => $value){
            if(strpos($key,'btn') === 0){
                $maqEsc = $key;
                break;
            }
        }

        $item = ($maqEsc == 'btn1') ? 'ds2' :
                (($maqEsc == 'btn2') ? 'k18' :
                (($maqEsc == 'btn3') ? 'resistencia' : 'Undefined'));

        $selected = ($item == 'ds2') ? 'DS-2' :
                    (($item == 'k18') ? 'K-18' :
                    (($item == 'resistencia') ? 'Resistencia' : 'Undefined'));
    }
