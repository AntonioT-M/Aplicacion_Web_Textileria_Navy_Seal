<?php
require_once '../class/Materiales.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $op = new Materiales();
    $op->setIdMaterial($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>