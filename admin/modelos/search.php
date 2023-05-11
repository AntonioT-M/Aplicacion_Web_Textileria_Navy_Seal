<?php
require_once '../class/Modelos.php';
require_once '../class/Materiales.php';

$s = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
$c = (isset($_REQUEST['c'])) ? $_REQUEST['c'] : null;


if($s || $c){
    $output = "";
    $results = Modelos::search($s,$c);
    if(count($results) > 0){
        $output.='<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
        <thead>
            <tr>
                <td>#</td>
                <td>Imagen</td>
                <td>Modelo</td>
                <td>Talla</td>
                <td>Código</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>';
        $i=1; foreach($results as $item):
            $output.='<tr>
            <td>'.$i++.'</td>
            <td><img height="80" width="80" style="transform: rotate(11deg);" src="'.$item['imgModelo'].'" alt="Imagen del modelo"></td>
            <td>'.$item['modelo'].'</td>
            <td>'.$item['talla'].'</td>
            <td>'.$item['codigo'].'</td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm('.$item["idModelo"].')">
                        <i class="fa fa-pencil"></i>
                    </button>
                </form>
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR('.$item['idModelo'].')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>';            
        endforeach;
        $output.='</tbody>
        </table>';
    }else{
        $output.='<div class="col-md-12">
        <p class="centered" style="font-size: 17px; border-left: 10px solid red; border-right: 10px solid red; color: red">
            Sin considencias
        </p>
        </div>';
    }
    echo $output;
}

if(isset($_REQUEST['newMaterial'])){
    $mtrls = (isset($_REQUEST['newMaterial'])) ? $_REQUEST['newMaterial'] : null;
    $idModelo = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    $output2 = "";
    $arrayMaterial = [];
    $arrayGHilo = [];
    $arraySistemas = [];
    if($idModelo){
        $objectModeloR = Modelos::searchById($idModelo);
        $arrayMaterial = explode(",",$objectModeloR->getMateriales());
        $arrayGHilo = explode(",", $objectModeloR->getGuiaHilo());
        $arraySistemas = explode(";", $objectModeloR->getSistemasN());
    }
    $objectM = new Materiales();
    $objectM = $objectM->getAll(); 
    if($mtrls >=1){
        for($i = 0; $mtrls > $i; $i++){
            $output2.='<div class="col-sm-12">
            <hr color="black" size="1" width="100%">
            </div>
            <div class="col-sm-12 showB">
            <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideMaterials('.$i.');" title="Ocultar/Mostrar">Material '.($i+1).' <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
            <hr color="black" size="1" width="100%">
            </div>
            <div class="form-group col-md-4 showMatrl'.$i.' showB">
                <label for="">Material</label>
                <select class="form-control" name="material[]" id="material'.$i.'" onchange="showInformationMaterial('.$i.')" required>
                    <option value="">Selecciona Material</option>';
                    if($objectM){foreach($objectM as $item){
                        $output2.='<option value="'.$item['material'].'"';
                        if($idModelo){
                            if(count($arrayMaterial) <= $i){
                                $arrayMaterial[$i] = "";
                            }
                            if($item['material'] == $arrayMaterial[$i]){ 
                                $output2.= "Selected";
                            }else{
                                $output2.="";
                            }
                        }
                        $output2.= '>'.$item['material'].'</option>';
                    }}
                $output2.='</select>
            </div>
            <div class="form-group col-md-4 showMatrl'.$i.' showB">
                <label for="">Guia Hilo</label>
                <input class="form-control" type="number" placeholder="G.Hilo" min="1" max="9" minlenght="1" maxlength="1" id="guiaHilo" name="guiaHilo[]" onKeypress="return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value > this.max){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < this.min){this.value = this.value.slice(0, (minLength-1))}" value="';
                if($idModelo){
                    if(count($arrayGHilo) <= $i){
                        $arrayGHilo[$i] = "";
                    }
                    $output2.=$arrayGHilo[$i];
                }
                $output2.='"  required>
            </div>
            <div class="form-group col-md-4 showMatrl'.$i.' showB">
                <label for="">Sistemas</label>
                <select class="form-control" id="s'.$i.'" onchange="putSistemsOnI('.$i.');">
                    <option value="">Selecciona Sistemas</option>
                    <option value="1" ';
                    if($idModelo){
                        if(count($arraySistemas) <= $i){
                            $arraySistemas[$i] = "";
                        }
                        if($arraySistemas[$i] == '1,2,3,4,5,6,7,8,9'){
                            $output2.="Selected";
                        }
                    }
                    $output2.='>Todos</option>
                    <option value="2" ';
                    if($idModelo){
                        if(count($arraySistemas) <= $i){
                            $arraySistemas[$i] = "";
                        }
                        if($arraySistemas[$i] == '2,4,6,8'){
                            $output2.="Selected";
                        }
                    }
                    $output2.='>Pares</option>
                    <option value="3" ';
                    if($idModelo){
                        if(count($arraySistemas) <= $i){
                            $arraySistemas[$i] = "";
                        }
                        if($arraySistemas[$i] == '1,3,5,7,9'){
                            $output2.="Selected";
                        }
                    }
                    $output2.='>Nones</option>
                    <option value="4" ';
                    if($idModelo){
                        if(count($arraySistemas) <= $i){
                            $arraySistemas[$i] = "";
                        }
                        if($arraySistemas[$i] != '1,2,3,4,5,6,7,8,9' && $arraySistemas[$i] != '2,4,6,8' && $arraySistemas[$i] != '1,3,5,7,9' && $arraySistemas[$i] != ""){
                            $output2.="Selected";
                        }
                    }
                    $output2.='>Especificos</option>
                </select>
            </div>
            <div class="form-group col-md-4 showMatrl'.$i.' showB">
                <label for="">Sistemas</label>
                <input class="form-control" id="m'.$i.'" maxlength="18" minlength="1" name="sistemasN[]" type="text" onchange="getSistemsOfI();" placeholder="Sistemas Necesarios" style="text-transform: capitalize;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 44)" oninput="if(this.value.length > maxLength){ this.value = this.value.slice(0, this.maxLentgh)}else if(this.value.length < this.minLength){this.value = this.value.slice(0, this.minLength-1)}" value="';
                if($idModelo){
                    if(count($arraySistemas) <= $i){
                        $arraySistemas[$i] = "";
                    }
                    $output2.=$arraySistemas[$i];
                }
                $output2.='" readonly required>
            </div>
            <div class="form-group col-md-8 showMatrl'.$i.' showB" style="border-left: 6px solid yellow; background-color: lightgray;">
                    <div class="row" id="showInfMaterial'.$i.'"></div>
            </div>';
        }
        echo $output2;
    }
}

if(isset($_REQUEST['shMaterial'])){
    $mtl = (isset($_REQUEST['shMaterial'])) ? $_REQUEST['shMaterial'] : null;
    if($mtl != null){
        $material = new Materiales();
        $objM = $material->search($mtl);
        $material = $material->searchById($objM[0]['idMaterial']);
        if($material){
            $output3 = '<div class="col-md-8"><h5>Información de material</h5><p>Torción: '.$material->getTorcion().'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Calibre: '.$material->getCalibre().'</p></div>';
            echo $output3;
        }
    }
}
?>