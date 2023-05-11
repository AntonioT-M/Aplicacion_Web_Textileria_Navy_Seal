<?php
require_once '../class/Clientes.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $op = new Clientes();
    $op->setIdCliente($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>