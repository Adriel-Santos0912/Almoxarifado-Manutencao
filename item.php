<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formStyle.css">
    <title>Cadastrar Item</title>
</head>
<body>
    <?php
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

            $form = ($item == 'ds2') ? 'HTML/formDS2.html' :
                (($item == 'k18') ? 'HTML/formK18.html' :
                (($item == 'resistencia') ? 'HTML/formResistencia.html' : 'null'));

            if ($form) {
                header('Location: ' . $form);
                exit;
            }
        }
    ?>
</body>
</html>


