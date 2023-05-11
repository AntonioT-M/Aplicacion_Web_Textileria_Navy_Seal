<?php
require_once '../class/Administradores.php';

$data = (isset($_REQUEST['datos'])) ? $_REQUEST['datos'] : null;
$data2=[];
$e = 0;
foreach($data as $i =>$v){
    $data2[$e]= $v['value'];
    $e++;
}
if($data2[0] == ""){
    $data2[0] = null;
}
$errors = 0;
for($r = 1;count($data2) > $r; $r++){
    if($data2[$r] == ""){
        $errors++;
    }
}
if($errors >= 1){
    echo "Llena: ".$errors." campo/s restante/s";
}else{
    if(strlen($data2[1]) <= 3){
        echo "El nombre debe ser mayor a 3 caracteres\nTe falta/n: ".(4 - strlen($data2[1]));
    }else if(strlen($data2[2]) <= 3){
        echo "Los apellidos deben ser mayores a 3 caracteres\nTe falta/n: ".(4 - strlen($data2[2]));
    }else if(strlen($data2[5]) <= 5){
        echo "El password debe ser mayor a 5 caracteres\nTe falta/n: ".(6 - strlen($data2[5]));
    }else{
        $admin = new Administradores($data2[1], $data2[2], $data2[3], strtoupper($data2[4]), $data2[5], $data2[6], $data2[0]);
        if(($admin->save()) == true){
            echo "Perfect";
        }else{
            echo "Bad";
        }
    }
}
?>