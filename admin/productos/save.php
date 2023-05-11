<?php
require_once '../class/Productos.php';
require_once '../class/Pedidos.php';

//Array Generado con datos individuales provenientes del formulario
$data[0]['value'] = (isset($_REQUEST['idProducto'])) ? $_REQUEST['idProducto'] : null;
$data[1]['value'] = (isset($_REQUEST['idPedido'])) ? $_REQUEST['idPedido'] : null;
$data[2]['value'] = (isset($_REQUEST['idOperador'])) ? $_REQUEST['idOperador'] : null;
$data[3]['value'] = (isset($_REQUEST['idMaquina'])) ? $_REQUEST['idMaquina'] : null;
$data[4]['value'] = (isset($_REQUEST['folio'])) ? $_REQUEST['folio'] : null;
$data[5]['value'] = (isset($_REQUEST['ln'])) ? $_REQUEST['ln'] : null;
$data[6]['value'] = (isset($_REQUEST['acumulado'])) ? $_REQUEST['acumulado'] : "0";
$data[7]['value'] = (isset($_REQUEST['observaciones'])) ? $_REQUEST['observaciones'] : null;
//$ln = (isset($_REQUEST['ln'])) ? $_REQUEST['ln'] : null;
//Arrays directos provenientes del formulario
$fechas = (isset($_REQUEST['fechas'])) ? $_REQUEST['fechas'] : null;
$piezas = (isset($_REQUEST['piezas'])) ? $_REQUEST['piezas'] : null;
$turnos = (isset($_REQUEST['turnos'])) ? $_REQUEST['turnos'] : null;
$operadores = (isset($_REQUEST['operadores'])) ? $_REQUEST['operadores'] : null;
//Proceso de verificación de información y validaciónes
    $data2=[];
    $e = 0;
    $errorC = 0;
    foreach($data as $i =>$v){
        $data2[$e]= $v['value'];
        $e++;
    }
    if($data2[0] == ""){
        $data2[0] = null;
    }
    if($data2[7] == ""){
        $data2[7] = "N/A";
    }
    for($r = 1;count($data2) > $r; $r++){
        if($data2[$r] == ""){
            $errorC++;
        }
    }
    if($errorC == 0){
            $errorC = 0;
            for($i = 0; ($f = count($fechas)) > $i; $i++){
                if($fechas[$i] == ""){
                    $errorC++;
                }
            }
            if($errorC == $f){
                $fechas = "N/A";
            }else if($errorC == ($f-1)){
                for($i = 0; $f > $i; $i++){
                    if($fechas[$i] != ""){
                        $tmp = $i;
                    }
                }
                $fechas = $fechas[$tmp];
            }else{
                $fechas = implode(",",$fechas);
            }
            $errorC = 0;
            for($i = 0; ($p = count($piezas)) > $i; $i++){
                if($piezas[$i] == ""){
                    $errorC++;
                }
            }
            if($errorC == $p){
                $piezas = "N/A";
            }else if($errorC == ($p-1)){
                for($i = 0; $p > $i; $i++){
                    if($piezas[$i]  != ""){
                        $tmp = $i;
                    }
                }
                $piezas = $piezas[$tmp];
            }else{
                $piezas = implode(",",$piezas);
            }
            $errorC = 0;
            for($i = 0; ($t = count($turnos)) > $i; $i++){
                if($turnos[$i] == ""){
                    $errorC++;
                }
            }
            if($errorC == $p){
                $turnos = "N/A";
            }else if($errorC == ($t-1)){
                for($i = 0; $t > $i; $i++){
                    if($turnos[$i] != ""){
                        $tmp = $i;
                    }
                }
                $turnos = $turnos[$tmp];
            }else{
                $turnos = implode(",",$turnos);
            }
            $errorC = 0;
            for($i = 0; ($o = count($operadores)) > $i; $i++){
                if($operadores[$i] == ""){
                    $errorC++;
                }
            }
            if($errorC == $o){
                $operadores = "N/A";
            }else if($errorC == ($o-1)){
                for($i = 0; $o > $i; $i++){
                    if($operadores[$i] != ""){
                        $tmp = $i;
                    }
                }
                $operadores = $operadores[$tmp];
            }else{
                $operadores = implode(",",$operadores);
            } 
            $producto = new Productos($data2[1], $data2[3], $data2[2], $data2[4], $fechas, $data2[5], $piezas, $data2[6], $data2[7], "N/A", "N/A", $operadores, $turnos, "N/A", "N/A", $data2[0]);
            if($data2[6] == ($pedido = (new Pedidos())->searchByid($data2[1]))->getCantidad()){
                $pedido->setEstadoPedido(1);
                $pedido->save();
            }
            if($producto->save()){
                echo "Perfect";
            }else{
                echo "Bad";
            }
    }else{
        echo "Llena todos los campos principales";
    }

?>