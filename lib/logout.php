<?php
date_default_timezone_set('America/Mexico_City');
session_start();
unset($_SESSION['nombre']);
unset($_SESSION['apellidos']);
unset($_SESSION['nick']);
unset($_SESSION['x']);
unset($_SESSION['privilegios']);
session_destroy();
header('Location: ../login.php');
?>