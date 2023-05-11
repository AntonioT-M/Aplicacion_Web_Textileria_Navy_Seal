<?php
session_start();
require_once '../admin/class/Administradores.php';
require_once '../admin/class/Operadores.php';

$nick = (isset($_REQUEST['nick'])) ? $_REQUEST['nick'] : null;
$pass = (isset($_REQUEST['pass'])) ? $_REQUEST['pass'] : null;

if($nick == ""){
    echo "Ingrese su Nick";
}else if($pass == ""){
    echo "Ingrese su Password";
}else{
    $admin = new Administradores(null, null, null, $nick, $pass, null, null);
    $login = $admin->login();
    if($login == true){
        echo "Perfect";
       /*echo '<script>
                alert("Nick o password incorrectos");
                window.location.href="../login.php";
            </script>';*/
    }else if((new Operadores(null, null, null, $nick, $pass, null, null))->login() == true){
        echo "Perfect";
    }else{
        echo "Bad";
    }
}

/*if($login == true){
    if($_SESSION['privilegiosAdmin'] == 1){
        /**echo '<script>
            alert("Bienvenid@ '.$_SESSION['nombreAdmin'].' '.$_SESSION['apellidosAdmin'].'");
            window.location.href="../admin/index.php";
        </script>';
    }
}*/

?>