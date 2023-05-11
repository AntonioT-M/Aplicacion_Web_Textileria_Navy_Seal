<?php
require_once '../class/Administradores.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;

if($id){
    $admin = new Administradores();
    $admin->setIdAdminnistrador($id);
    if($admin->delete() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}
?>