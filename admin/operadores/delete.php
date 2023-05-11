<?php
require_once '../class/Operadores.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $op = new Operadores();
    $op->setIdOperador($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>