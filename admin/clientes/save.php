<?php

use PhpOffice\PhpSpreadsheet\Cell\DataType;

require_once '../class/Clientes.php';

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
    }else if($data2[2] == "Formal"){
        if($data2[3] == "N/A"){
            echo "Debe introduccir una razón social valida";
        }else if(strlen($data2[3]) <= 10){
            echo "La razón social debe ser mayor a 10 caracteres\nTe falta/n: ".(10 - strlen($data2[3]));
        }else{
            $op = new Clientes($data2[1], $data2[3], $data2[2], $data2[0]);
            if(($op->save()) == true){
                echo "Perfect";
            }else{
                echo "Bad";
            }
        }
    }else if($data2[2] == "Informal"){
        $op = new Clientes($data2[1], $data2[3], $data2[2], $data2[0]);
        if(($op->save()) == true){
            echo "Perfect";
        }else{
            echo "Bad";
        }
    }
}
?>