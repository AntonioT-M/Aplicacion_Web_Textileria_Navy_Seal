<?php
require_once '../class/Productos.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $op = new Productos();
    $op->setIdProducto($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>