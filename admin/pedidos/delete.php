<?php
require_once '../class/Pedidos.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $op = new Pedidos();
    $op->setIdPedido($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>