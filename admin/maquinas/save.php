<?php

use PhpOffice\PhpSpreadsheet\Cell\DataType;

require_once '../class/Maquinas.php';

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
    if(strlen($data2[1]) <= 8){
        echo "El nombre debe ser mayor a 8 caracteres\nTe falta/n: ".(8 - strlen($data2[1]));
    }else if(strlen($data2[2]) <= 4){
            echo "El modelo debe ser mayor a 4 caracteres\nTe falta/n: ".(4 - strlen($data2[2]));
    }else{
        $op = new Maquinas(ucwords($data2[1]), strtoupper($data2[2]), $data2[4], $data2[3], $data2[0]);
        if(($op->save()) == true){
            echo "Perfect";
        }else{
            echo "Bad";
        }
    }
}
?>