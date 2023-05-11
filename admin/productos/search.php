<?php
require_once '../class/Productos.php';
require_once '../class/Pedidos.php';
require_once '../class/Modelos.php';
require_once '../class/Clientes.php';
require_once '../class/Maquinas.php';
require_once '../class/Operadores.php';
session_start();

$s = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
$c = (isset($_REQUEST['c'])) ? $_REQUEST['c'] : null;

if($s || $c){
    $output = "";
    $results = Productos::search($s,$c);
    if($_SESSION['privilegios'] == 4){
        for($i = 0; count($results) > $i; $i++){
            if($results[$i]['nombreOperador'] != $_SESSION['nombre'] && $results[$i]['apellidosOperador'] != $_SESSION['apellidos']){
                unset($results[$i]);
            }
        }
    }
    if(count($results) > 0){
        $output.='<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
        <thead>
            <tr>
                <td>#</td>
                <td>Imagen</td>
                <td>Modelo</td>
                <td>Talla</td>
                <td>Cantidad</td>
                <td>Maquina</td>
                <td>Operador</td>
                <td>Estado</td>
                <td></td>';
                if($_SESSION['privilegios'] < 4){
                    $output.='<td></td>';
                }
            $output.='</tr>
        </thead>
        <tbody>';
        $i=1; foreach($results as $item):
            $output.='<tr>
            <td>'.$i++.'</td>
            <td><img height="80" width="80" style="transform: rotate(11deg);" src="../modelos/'.$item['imgModelo'].'" alt="Imagen del modelo"></td>
            <td>'.$item['modelo'].'</td>
            <td>'.$item['talla'].'</td>
            <td>'.$item['cantidad'].'</td>
            <td>'.$item['maquina'].'</td>
            <td>'.$item['nombreOperador'].' '.$item['apellidosOperador'][1].'.'.'</td>
            <td>';if($item['estadoPedido'] == 3){ $output.="En espera"; }else if($item['estadoPedido'] == 2){$output.="En proceso"; }else if($item['estadoPedido'] == 1){$output.="Terminado";}
            $output.='</td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="';
                    if($_SESSION['privilegios'] < 4){
                        $output.="showForm";
                    }else{
                        $output.="showFormForOp";
                    }
                    $output.='('.$item["idProducto"].')">';
                    if($_SESSION['privilegios'] < 4){
                        $output.='<i class="fa fa-pencil"></i>';
                    }else{
                        $output.='<i class="fa fa-gear"></i>';
                    }
                    $output.='</button>
                </form>
            </td>';
            if($_SESSION['privilegios'] < 4){
                $output.='<td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR('.$item['idProducto'].')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>';
            }
        $output.='</tr>';            
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
if(isset($_REQUEST['idPedido'])){
    $idPedido = (isset($_REQUEST['idPedido'])) ? $_REQUEST['idPedido'] : null;
    $output5 = "";
    if($idPedido){
        $imgObjectM = Modelos::searchById((Pedidos::searchByid($idPedido)->getIdModelo()));
        $output5.= '<label for="">Imagen del Módelo</label>
        <div id="preview" style="text-align: center; max-width: 100%; width: 100%; height: 100%; max-height: 100%; line-height: 20px;">
            <img id="show" src="';
            if($imgObjectM){ $output5.='../modelos/'.$imgObjectM->getImgModelo();} 
            $output5.='" height="200" width="200" alt=" " />
        </div>';
    }
    echo $output5;
}

if(isset($_REQUEST['idP'])){
    $idP = (isset($_REQUEST['idP'])) ? $_REQUEST['idP'] : null;
    $output6 = "";
    if($idP != ""){
        $model = Modelos::searchById((($pedido = Pedidos::searchByid($idP))->getIdModelo()));
        $aMaterials = explode(',',$model->getMateriales());
        $aGHilo = explode(',', $model->getGuiaHilo());
        $aSistemas = explode(';',$model->getSistemasN());
        $output6.= '<div class="form-group col-md-4 showA">
        <label for="">Talla</label>
        <input class="form-control" type="text" name="talla" id="talla" style="text-transform: uppercase;" value="'.$model->getTalla().'" placeholder="Talla del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Código</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" value="'.$model->getCodigo().'" placeholder="Codigo del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Ancho</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" value="'.$pedido->getAnchoI().'" placeholder="Ancho del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Largo</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" value="'.$pedido->getLargoI().'" placeholder="Largo del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Piezas a Producir</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" value="'.$pedido->getCantidad().'" placeholder="Piezas a producir" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Lotes Necesarios</label>
            <input class="form-control" type="number" placeholder="Lotes" name="ln" id="ln" min="1" max="15" maxlength="2" minlength="1" onchange="getControlsToFormProduct();" style="text-transform: capitalize;" value="';
            $lotes = 0;
            $ctd = $pedido->getCantidad();
            $sigue = true;
            $i = 2;
            $s = 0;
            $p;
            if($ctd > 65){
                while($sigue){
                    if($ctd % $i == 0 && ($ctd/$i) <= 60 && ($ctd/$i) >= 20|| $ctd == $i){
                        $sigue = false;
                    }else{
                        $i++;
                    }
                }
                if($ctd == $i){
                    while($ctd != 0){
                        if($ctd >= 50){
                            $ctd = $ctd-50;
                            $s++;
                        }else{
                            $p = $ctd;
                            $ctd = $ctd-$p;
                        }
                    }
                    $lotes = $s+1;
                }else{
                    $lotes = $i;
                }                            
            }else{
                $lotes = 1;
            }
            $output6.= $lotes;
            $output6.='" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value > this.max){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < 1){this.value = this.value.slice(0, (minLength-1))}" readonly required>
         </div>
        <div class="form-group col-sm-12 showA">
        <p>Materiales</p>
                        <table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Material</td>
                                        <td>G.Hilo</td>
                                        <td>Sistemas</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                for($i = 0; count($aMaterials) > $i;$i++){
                                    $output6.='<tr>
                                        <td>'.($i+1).'</td>
                                        <td>'.$aMaterials[$i].'</td>
                                        <td>'.$aGHilo[$i].'</td>
                                        <td>';
                                        if($aSistemas[$i] == '1,2,3,4,5,6,7,8,9'){
                                            $aSistemas[$i] = 'Todos';
                                        }else if($aSistemas[$i] == '2,4,6,8'){
                                            $aSistemas[$i] = 'Pares';
                                        }else if($aSistemas[$i] == '1,3,5,7,9'){
                                            $aSistemas[$i] = 'Nones';
                                        }else if($aSistemas[$i] != ""){
                                            $temp = $aSistemas[$i];
                                            $aSistemas[$i] = 'Especificos:'.$temp;
                                        }
                                        $output6.=$aSistemas[$i].'</td>
                                    </tr>';
                                }
                                $output6.='</tbody>
                        </table>
                    </div>
                    <script>
                        $(document).ready(function(){ 
                            getControlsToFormProduct();
                            showImgModelToProduct();
                            setSpf();
                        });
                    </script>';
                    /*$ctd = 66;
                    $sigue = true;
                    $i = 2;
                    $s = 0;
                    $p;
                    if($ctd > 65){
                        while($sigue){
                            if($ctd % $i == 0 && ($ctd/$i) <= 60 && ($ctd/$i) >= 20|| $ctd == $i){
                                $sigue = false;
                            }else{
                                $i++;
                            }
                        }
                        if($ctd == $i){
                            while($ctd != 0){
                                if($ctd >= 50){
                                    $ctd = $ctd-50;
                                    $s++;
                                }else{
                                    $p = $ctd;
                                    $ctd = $ctd-$p;
                                }
                            }
                            var_dump('Lotes: '.$s.' Piezas por lote: '.$ctd.' Third p: '.$p);
                            //var_dump('Lotes: 2, Piezas por lote: '.round($ctd/2).' Third');        
                        }else{
                            var_dump('Lotes: '.$i.', Piezas por lote: '.($ctd/$i).' Second');
                        }                            
                    }else{
                        var_dump('Lotes: 1, Piezas por lote: '.$ctd.' First');
                    }*/
    }else{
        $output6.= '<div class="form-group col-md-4 showA">
        <label for="">Talla</label>
        <input class="form-control" type="text" name="rfc" id="rfc" style="text-transform: uppercase;" placeholder="Talla del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Código</label>
            <input class="form-control" type="text" name="tipo" id="tipo" style="text-transform: capitalize;" placeholder="Codigo del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Ancho</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" placeholder="Ancho del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Largo</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" placeholder="Largo del modelo" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Piezas a Producir</label>
            <input class="form-control" type="text" name="codigo" id="codigo" style="text-transform: capitalize;" placeholder="Piezas a producir" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Lotes Necesarios</label>
            <input class="form-control" type="number" placeholder="Lotes" name="ln" id="ln" min="1" max="20" maxlength="2" minlength="2" onchange="getControlsToFormProduct();" style="text-transform: capitalize;" value="<?php //if($object){echo $nm;}?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value >= 6){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < 1){this.value = this.value.slice(0, (minLength-1))}" disabled required>
         </div>';
    }
    echo $output6;
}

if(isset($_REQUEST['idP2'])){
    $idP2 = (isset($_REQUEST['idP2'])) ? $_REQUEST['idP2'] : null;
    $idProducto = (isset($_REQUEST['idProducto'])) ? $_REQUEST['idProducto'] : null;
    $output7 = "";
    if($idP2 != ""){
        $objectProduct = Productos::searchById($idProducto);
        $objectC = Clientes::searchById((Pedidos::searchByid($idP2)->getIdCliente()));
        $output7.= '<div class="form-group col-md-4 showA">
        <label for="">Folio</label>
        <input class="form-control" type="text" name="folio" maxlength="5" minlength="1" id="folio" style="text-transform: uppercase;" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value > this.max){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < 1){this.value = this.value.slice(0, (minLength-1))} setSpf();" placeholder="Folio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="';
        if($objectProduct){
            $output7.=$objectProduct->getFolio();
        }
        $output7.='"';
         if($_SESSION['privilegios'] > 3){ $output7.= 'readonly'; }
        $output7.='>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Cliente</label>
            <input class="form-control" type="text" name="nombreCliente" id="nombreCliente" style="text-transform: uppercase;" value="'.$objectC->getNombreC().'" placeholder="Nombre del cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">RFC</label>
            <input class="form-control" type="text" name="rfc" id="rfc" style="text-transform: uppercase;" value="'.$objectC->getRSocial().'" placeholder="RFC del Cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Tipo</label>
            <input class="form-control" type="text" name="tipo" id="tipo" style="text-transform: capitalize;" value="'.$objectC->getTipo().'" placeholder="Tipo de Cliente" disabled>
        </div>';
        /*if($objectProduct){
            $output7.='<script>
                $(document).ready(function(){ 
                    setSpf();
                });
            </script>';
        }*/
    }else{
        $output7.= '<div class="form-group col-md-4 showA">
        <label for="">Folio</label>
        <input class="form-control" type="text" name="folio" id="folio" style="text-transform: uppercase;" oninput="setSpf();" placeholder="Folio" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Cliente</label>
            <input class="form-control" type="text" name="nombreCliente" id="nombreCliente" style="text-transform: uppercase;" placeholder="Nombre del Cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">RFC</label>
            <input class="form-control" type="text" name="rfc" id="rfc" style="text-transform: uppercase;" placeholder="RFC del Cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Tipo</label>
            <input class="form-control" type="text" name="tipo" id="tipo" style="text-transform: capitalize;" placeholder="Tipo de Cliente" disabled>
        </div>';
    }
    echo $output7;
}

if(isset($_REQUEST['idMaq']) && isset($_REQUEST['idP3'])){
    $idMaq = (isset($_REQUEST['idMaq'])) ? $_REQUEST['idMaq'] : null;
    $idP3 = (isset($_REQUEST['idP3'])) ? $_REQUEST['idP3'] : null;
    if($idMaq != null && $idP3 != null){
        $maqI = (new Maquinas())->searchById($idMaq);
        $modelo = (new Modelos())->searchById(((new Pedidos())->searchByid($idP3))->getIdModelo());
        if($maqI){
            $output3 = '<div style="border-left: 6px solid yellow; background-color: lightgray;" class="col-md-4 showA"><h5>Información</h5><p>S. Maquina: '.$maqI->getSistemasT().'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div>';
            echo $output3;
        }
    }
}
if(isset($_REQUEST['ln']) && isset($_REQUEST['idP4']) || isset($_REQUEST['ln']) && isset($_REQUEST['idP4']) && isset($_REQUEST['idControl']) && isset($_REQUEST['piezasEnd'])){
    $ln = (isset($_REQUEST['ln'])) ? $_REQUEST['ln'] : null;
    $idP4 = (isset($_REQUEST['idP4'])) ? $_REQUEST['idP4'] : null;
    $idControl = (isset($_REQUEST['idControl'])) ? $_REQUEST['idControl'] : null;
    $piezasEnd = (isset($_REQUEST['piezasEnd'])) ? $_REQUEST['piezasEnd'] : null;
    $idOperador = (isset($_REQUEST['idOperador'])) ? $_REQUEST['idOperador'] : null;
    $idProducto = (isset($_REQUEST['idProduct2'])) ? $_REQUEST['idProduct2'] : null;
    $output8 = "";
    $fechas = "";
    $turnos = "";
    $operadores = "";
    $acumulado = "0";
    $operador = Operadores::searchById($idOperador);
    if($ln != null && $idP4 != null){
        $pedido = Pedidos::searchByid($idP4);
        $piezas = [];
        $ctd = $pedido->getCantidad();
        $sigue = true;
        $i = 2;
        $s = 0;
        $p;
        if($ctd > 65){
            while($sigue){
                if($ctd % $i == 0 && ($ctd/$i) <= 60 && ($ctd/$i) >= 20|| $ctd == $i){
                    $sigue = false;
                    $piezas[0] = $ctd/$i;
                }else{
                    $i++;
                }
            }
            if($ctd == $i){
                while($ctd != 0){
                    if($ctd >= 50){
                        $ctd = $ctd-50;
                        $piezas[$s] = 50;
                        $s++;
                    }else{
                        $p = $ctd;
                        $ctd = $ctd-$p;
                        $piezas[$s] = $p;
                    }
                }
                //$piezas = $s+1;
            }else{
                //$piezas = $i;
            }                            
        }else{
            $piezas[0] = $ctd;
        }
        if($idProducto){
            $fechas = explode(",",($product = Productos::searchById($idProducto))->getFechas());
            $turnos = explode(",", $product->getTurnos());
            $operadores = explode(",", $product->getOperadores());
            $acumulado = $product->getAcumulado();
        }
        //$turnos = explode(",",$product->getTurnos());
        $output8.='<div class="centered">
        <div class="col-sm-12">
            <h3><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Producción <i class="fa fa-cog fa-spin fa-1x fa-fw"></i></h3>
        </div>
        <div class="col-sm-6">
            <h4>Total acumulado: <span style="color: green; font-size: 150%;">'; if($piezasEnd){ if(count($piezas) > 1){ if(($idControl-1) != -1){$output8.= $acumulado = ($piezas[$idControl]+($piezas[$idControl-1]*($idControl)));}else{ $output8.= $acumulado = ($piezas[$idControl]+($piezas[$idControl]*($idControl)));}}else{ $output8.= ($acumulado = $piezas[0]*($idControl+1));}}else if($acumulado > 0){ $output8.=$acumulado;}else{$output8.="0";}
            $output8.='</span></h4><input type="hidden" name="acumulado" id="acumulado" value="'.$acumulado.'">
        </div>
        <div class="col-sm-6">
            <h4>Total faltante: <span style="color: red; font-size: 150%;">'.($pedido->getCantidad()-$acumulado).'</span></h4>
        </div>
        </div>
        <div class="col-sm-12">
        <hr color="black" size="1" width="100%">
        </div>';
        if($ln >= 1){
            if(count($piezas) > 1){
                for($i = 0; $ln > $i; $i++){
                    $output8.='<div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12 showB">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideLotes('.$i.');" title="Ocultar/Mostrar">Lote '.($i+1).' <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Fecha</label>
                        <input class="form-control" type="text" name="fechas[]" id="fechas'.$i.'" value="';
                        if($idControl != null && $idControl == $i){ $output8.=date('d/m/Y');}else if($fechas){ if(count($fechas) <= $i){ $fechas[$i] = "";} if($fechas[$i] == "N/A"){$fechas[$i] = "";} $output8.= $fechas[$i];}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Turno</label>
                        <input class="form-control" type="text" name="turnos[]" id="turnos'.$i.'" value="';
                        if($operador){if($idControl != null && $idControl == $i){ $output8.=$operador->getTurnoOperador();}else if($turnos){ if(count($turnos) <= $i){ $turnos[$i] = "";} if($turnos[$i] == "N/A"){$turnos[$i] = "";} $output8.= $turnos[$i];}}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Operador</label>
                        <input class="form-control" type="text" name="operadores[]" id="operadores'.$i.'" style="text-transform: capitalize;" value="';
                        if($operador){if($idControl != null && $idControl == $i){ $output8.=$operador->getNombreOperador()." ".$operador->getApellidosOperador()[1].".";}else if($operadores){ if(count($operadores) <= $i){ $operadores[$i] = "";} if($operadores[$i] == "N/A"){$operadores[$i] = "";} $output8.= $operadores[$i];}}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Lote</label>
                        <input class="form-control" type="number" name="" id="" value="'.($i+1).'" readonly required>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Piezas</label>
                        <input class="form-control" type="number" name="piezas[]" id="piezas'.$i.'" value="'.$piezas[$i].'" readonly required>
                    </div>
                    <div class="form-group col-sm-2 centered showLote'.$i.' showB">';
                    if($i == 0 && $fechas && $turnos && $operadores){
                        if($fechas[$i] != "" && $turnos[$i] != "" && $operadores[$i] != ""){ 
                            $output8.='<div style="border:1px solid #ffffff; margin-top: 13%; background-color: #82c671; color: #ffffff; text-shadow: -2px -2px 1px #545454, 2px 2px 1px #545454, -2px 2px 1px #545454, 2px -2px 1px #545454;"><h5>Lote Finalizado</h5></div>';
                        }else{
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')"><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"'; 
                            if($_SESSION['privilegios'] != 4){
                                $output8.="Disabled";
                            }
                            $output8.='></i></button>';
                        }
                    }else if($i > 0 && $fechas && $turnos && $operadores){
                        if($fechas[$i] != "" && $turnos[$i] != "" && $operadores[$i] != ""){ 
                            $output8.='<div style="border:1px solid #ffffff; margin-top: 13%; background-color: #82c671; color: #ffffff; text-shadow: -2px -2px 1px #545454, 2px 2px 1px #545454, -2px 2px 1px #545454, 2px -2px 1px #545454;"><h5>Lote Finalizado</h5></div>';
                        }else if($fechas[$i-1] != "" && $turnos[$i-1] != "" && $operadores[$i-1] != ""){
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')"';
                            if($_SESSION['privilegios'] != 4){
                                $output8.="Disabled";
                            }
                            $output8.='><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                        }else{
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')" disabled><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                        }
                    }else{
                        $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')" disabled><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                    }
                    $output8.='</div>';
                }
            }else{
                for($i = 0; $ln > $i; $i++){
                    $output8.='<div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12 showB">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideLotes('.$i.');" title="Ocultar/Mostrar">Lote '.($i+1).' <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Fecha</label>
                        <input class="form-control" type="text" name="fechas[]" id="fechas'.$i.'" value="';
                        if($idControl != null && $idControl == $i){ $output8.=date('d/m/Y');}else if($fechas){ if(count($fechas) <= $i){ $fechas[$i] = "";} if($fechas[$i] == "N/A"){$fechas[$i] = "";} $output8.= $fechas[$i];}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Turno</label>
                        <input class="form-control" type="text" name="turnos[]" id="turnos'.$i.'" value="';
                        if($operador){if($idControl != null && $idControl == $i){ $output8.=$operador->getTurnoOperador();}else if($turnos){ if(count($turnos) <= $i){ $turnos[$i] = "";} if($turnos[$i] == "N/A"){$turnos[$i] = "";} $output8.= $turnos[$i];}}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Operador</label>
                        <input class="form-control" type="text" name="operadores[]" id="operadores'.$i.'" value="';
                        if($operador){if($idControl != null && $idControl == $i){ $output8.=$operador->getNombreOperador()." ".$operador->getApellidosOperador()[1].".";}else if($operadores){ if(count($operadores) <= $i){ $operadores[$i] = "";} if($operadores[$i] == "N/A"){$operadores[$i] = "";} $output8.= $operadores[$i];}}
                        $output8.='" readonly>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Lote</label>
                        <input class="form-control" type="number" name="" id="" value="'.($i+1).'" readonly required>
                    </div>
                    <div class="form-group col-sm-2 showLote'.$i.' showB">
                        <label for="">Piezas</label>
                        <input class="form-control" type="number" name="piezas[]" id="piezas'.$i.'" value="'.$piezas[0].'" readonly required>
                    </div>
                    <div class="form-group col-sm-2 centered showLote'.$i.' showB">';
                    if($i == 0 && $fechas && $turnos && $operadores){
                        if($fechas[$i] != "" && $turnos[$i] != "" && $operadores[$i] != ""){ 
                            $output8.='<div style="border:1px solid #ffffff; margin-top: 13%; background-color: #82c671; color: #ffffff; text-shadow: -2px -2px 1px #545454, 2px 2px 1px #545454, -2px 2px 1px #545454, 2px -2px 1px #545454;"><h5>Lote Finalizado</h5></div>';
                        }else{
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')"';
                            if($_SESSION["privilegios"] != 4){
                                $output8.="Disabled";
                            }
                            $output8.='><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                        }
                    }else if($i > 0 && $fechas && $turnos && $operadores){
                        if($fechas[$i] != "" && $turnos[$i] != "" && $operadores[$i] != ""){ 
                            $output8.='<div style="border:1px solid #ffffff; margin-top: 13%; background-color: #82c671; color: #ffffff; text-shadow: -2px -2px 1px #545454, 2px 2px 1px #545454, -2px 2px 1px #545454, 2px -2px 1px #545454;"><h5>Lote Finalizado</h5></div>';
                        }else if($fechas[$i-1] != "" && $turnos[$i-1] != "" && $operadores[$i-1] != ""){
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')"';
                            if($_SESSION['privilegios'] != 4){
                                $output8.="Disabled";
                            }
                            $output8.='><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                        }else{
                            $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')" disabled><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                        }
                    }else{
                        $output8.='<button type="button" class="btn btn-success" id="control'.$i.'" onclick="getControlsToFormProduct('.$i.')" disabled><i class="fa fa-check fa-3x"><input id="btnC'.$i.'" type="hidden" value="'.$i.'"></i></button>';
                    }
                    $output8.='</div>';
                }
            }
        }
        echo $output8;
    }
}