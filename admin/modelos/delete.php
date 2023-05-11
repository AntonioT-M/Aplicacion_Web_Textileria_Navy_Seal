<?php
require_once '../class/Modelos.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    if(($op = Modelos::searchById($id))->getImgModelo() != "imgs/sinImagen.jpg"){
        unlink($op->getImgModelo());
    }
    $op->setIdModelo($id);
    if($op->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>