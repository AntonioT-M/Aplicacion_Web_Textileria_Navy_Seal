<?php
require_once '../class/Pedidos.php';
require_once '../class/Modelos.php';

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
    if($data2[4] < 20){
        echo "La cantidad debe ser mayor o igual a 20 \nTe faltan: ".(20 - $data2[4]);
    }else{
        $op = new Pedidos($data2[4], $data2[6], $data2[7], $data2[8], $data2[9], $data2[10], $data2[3], $data2[1], $data2[0]);
        if(($op->save()) == true){
            echo "Perfect";
        }else{
            echo "Bad";
        }
    }
}
?>