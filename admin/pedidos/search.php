<?php
require_once '../class/Pedidos.php';
require_once '../class/Modelos.php';
require_once '../class/Clientes.php';

$s = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
$c = (isset($_REQUEST['c'])) ? $_REQUEST['c'] : null;

$output = "";
if($s || $c){
    $results = Pedidos::search($s,$c);
    if(count($results) > 0){
        $output.='<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
        <thead>
            <tr>
                <td>#</td>
                <td>Cliente</td>
                <td>Modelo</td>
                <td>Talla</td>
                <td>Cantidad</td>
                <td>Estado</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>';
        $i=1; foreach($results as $item):
            $output.='<tr>
            <td>'.$i++.'</td>
            <td>'.$item['nombreC'].'</td>
            <td>'.$item['modelo'].'</td>
            <td>'.$item['talla'].'</td>
            <td>'.$item['cantidad'].'</td>';
            if($item['estadoPedido'] == 1){ $item['estadoPedido'] = 'Terminado';}else if($item['estadoPedido'] == 2){
                $item['estadoPedido'] = 'En Proceso';
            }else if($item['estadoPedido'] == 3){$item['estadoPedido'] = 'Es Espera';}
            $output.='<td>'.$item['estadoPedido'].'</td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm('.$item["idPedido"].')">
                        <i class="fa fa-pencil"></i>
                    </button>
                </form>
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR('.$item['idPedido'].')">
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
if(isset($_REQUEST['talla']) || isset($_REQUEST['idP1'])){
    $talla = (isset($_REQUEST['talla'])) ? $_REQUEST['talla'] : null;
    $id = (isset($_REQUEST['idP1'])) ? $_REQUEST['idP1'] : null;
    if($id != 0){
        $objectP = Pedidos::searchById($id);
    }
    $output2 = "";
    if($talla != ""){
        $objectM = Modelos::search(null,$talla);
        if(count($objectM)>0){
            $output2.='<select class="form-control" name="idModelo" id="idModelo" onchange="showImgModel();">
            <option value="">Selecciona Modelo</option>';
            foreach($objectM as $item){
                $output2.='<option value="'.$item['idModelo'].'"';
                if($id != 0){if($objectP->getIdModelo() == $item['idModelo']){ $output2.='Selected';}} 
                $output2.='>'.$item['modelo'].'</option>';
            }
            $output2.='</select><script>
            $(document).ready(function(){ showImgModel();});
            </script>';
        }else{
            $output2 = '<select class="form-control" name="idModelo" id="idModelo">
            <option value="">Selecciona Modelo</option></select>';
        }

    }else{
        $output2 = '<select class="form-control" name="idModelo" id="idModelo">
            <option value="">Selecciona Modelo</option></select>';
    }
    echo $output2;
}
if(isset($_REQUEST['id'])){
    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    $output3 = "";
    if($id){
        $imgObjectM = Modelos::searchById($id);
        $output3.= '<label for="">Imagen del Módelo</label>
        <div id="preview" style="text-align: center; max-width: 100%; width: 100%; height: 100%; max-height: 100%; line-height: 20px;">
            <img id="show" src="';
            if($imgObjectM){ $output3.='../modelos/'.$imgObjectM->getImgModelo();} 
            $output3.='" height="200" width="200" alt=" " />
        </div>';
    }
    echo $output3;
}
if(isset($_REQUEST['idC'])){
    $id = (isset($_REQUEST['idC'])) ? $_REQUEST['idC'] : null;
    $output4 = "";
    if($id != ""){
        $objectC = Clientes::searchById($id);
        $output4.= '<div class="form-group col-md-4 showA">
        <label for="">RFC</label>
        <input class="form-control" type="text" name="rfc" id="rfc" style="text-transform: uppercase;" value="'.$objectC->getRSocial().'" placeholder="RFC del Cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Tipo</label>
            <input class="form-control" type="text" name="tipo" id="tipo" style="text-transform: capitalize;" value="'.$objectC->getTipo().'" placeholder="Tipo de Cliente" disabled>
        </div>';
    }else{
        $output4 = '<div class="form-group col-md-4 showA">
        <label for="">RFC</label>
        <input class="form-control" type="text" name="rfc" id="rfc" style="text-transform: uppercase;" placeholder="RFC del Cliente" disabled>
        </div>
        <div class="form-group col-md-4 showA">
            <label for="">Tipo</label>
            <input class="form-control" type="text" name="tipo" id="tipo" style="text-transform: capitalize;" placeholder="Tipo de Cliente" disabled>
        </div>';
    }
    echo $output4;
}
?>