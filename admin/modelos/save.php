<?php
require_once '../class/Modelos.php';

//Array Generado con datos individuales provenientes del formulario
$data[0]['value'] = (isset($_REQUEST['idModelo'])) ? $_REQUEST['idModelo'] : null;
$data[1]['value'] = (isset($_REQUEST['modelo'])) ? $_REQUEST['modelo'] : null;
$data[2]['value'] = (isset($_REQUEST['talla'])) ? $_REQUEST['talla'] : null;
$data[3]['value'] = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
$nm = (isset($_REQUEST['nm'])) ? $_REQUEST['nm'] : null;
//Arrays directos provenientes del formulario
$materiales = (isset($_REQUEST['material'])) ? $_REQUEST['material'] : null;
$gHilo = (isset($_REQUEST['guiaHilo'])) ? $_REQUEST['guiaHilo'] : null;
$sistemasN = (isset($_REQUEST['sistemasN'])) ? $_REQUEST['sistemasN'] : null;
//Proceso de verificación de información y validaciónes
/*$file = tmpfile();
$path = stream_get_meta_data($file)['uri'];
var_dump($path);
fclose($file);*/
if($_FILES['url']['type'] == 'image/jpeg' || 
$_FILES['url']['type'] == 'image/png' || $_FILES['url']['type'] == 'image/jpg'){
    $serverPath = 'imgs';
    $imageName = $_FILES['url']['name'];
    $tmpPath = $_FILES['url']['tmp_name'];
    $destinyPath = $serverPath."/".(explode('.', $imageName))[0].date('dmyhis').".".(explode('.',$imageName))[1];
}else{
    $destinyPath = "imgs/sinImagen.jpg";
}
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
    for($r = 1;count($data2) > $r; $r++){
        if($data2[$r] == ""){
            $errorC++;
        }
    }
    if($errorC == 0){
        if(strlen($data2[1]) <= 3){
            echo "El Modelo debe ser mayor a 3 caracteres\nTe falta/n: ".(4 - strlen($data2[1]));
        }else if(strlen($data2[3]) <= 5){
            echo "El Código debe ser mayor a 5 caracteres\nTe falta/n: ".(6 - strlen($data2[3]));
        }else{
            if($nm != null){
                $errorC = 0;
                for($i = 0; count($materiales) > $i; $i++){
                    if($materiales[$i] == ""){
                        $errorC++;
                    }
                }
                if($errorC >= 1){
                    echo "Llena todos los campos de materiales";
                }else{
                    $errorC = 0;
                    $materiales = implode(',',$materiales);
                    for($i = 0; count($gHilo) > $i; $i++){
                        if($gHilo[$i] == ""){
                            $errorC++;
                        }
                    }
                    if($errorC >= 1){
                        echo "Llena todos los campos de Guia Hilo";
                    }else{
                        $errorC = 0;
                        $gHilo = implode(',',$gHilo);
                        for($i = 0; count($sistemasN) > $i; $i++){
                            if($sistemasN[$i] == ""){
                                $errorC++;
                            }
                        }
                        if($errorC >= 1){
                            echo "Llena todos los campos de sistemas";
                        }else if($errorC == 0){
                            $check = [];
                            for($i = 0; count($sistemasN) > $i; $i++){
                                $check[$i] = str_split($sistemasN[$i]);
                            }
                            for($i = 0; count($check) > $i; $i++){
                                for($c = 1; count($check[$i]) > $c; $c++){
                                    if($check[$i][$c] != ","){
                                        $errorC++;
                                    }else{
                                        $c++;
                                    }
                                }
                            }
                            if($errorC >= 1){
                                echo "El formato de aceptación es erroneo en alguno de los campos de sistemas";
                            }else{
                                $errorC = 0;
                                $sistemasN = implode(';',$sistemasN);
                                if($data2[0] == null){
                                    if($destinyPath != "imgs/sinImagen.jpg"){
                                        move_uploaded_file($tmpPath, $destinyPath);
                                    }
                                }else{
                                    $md = Modelos::searchById($data2[0])->getImgModelo();
                                    if($destinyPath != "imgs/sinImagen.jpg" && $destinyPath != $md){
                                        unlink($md);
                                        move_uploaded_file($tmpPath, $destinyPath);
                                    }else{
                                        $destinyPath = $md;
                                    }
                                }
                                $model = new Modelos($destinyPath, $data2[1], $data2[2], $materiales, $gHilo, $sistemasN, strtoupper($data2[3]), $data2[0]);
                                if($model->save()){
                                    echo "Perfect";
                                }else{
                                    echo "Bad";
                                } 
                            }
                        }
                    }
                }
            }else{
                echo "Ingresa la cantidad de materiales necesarios";
            }
        }
    }else{
        echo "Llena todos los campos principales";
    }

?>