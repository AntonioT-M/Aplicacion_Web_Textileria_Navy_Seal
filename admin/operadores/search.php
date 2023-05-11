<?php
require_once '../class/Operadores.php';

$s = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
$c = (isset($_REQUEST['c'])) ? $_REQUEST['c'] : null;

$output = "";
if($s || $c){
    $results = Operadores::search($s,$c);
    if(count($results) > 0){
        $output.='<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
        <thead>
            <tr>
                <td>#</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Turno</td>
                <td>Nick</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>';
        $i=1; foreach($results as $item):
            $output.='<tr>
            <td>'.$i++.'</td>
            <td>'.$item['nombreOperador'].'</td>
            <td>'.$item['apellidosOperador'].'</td>
            <td>'.$item['turnoOperador'].'</td>
            <td>'.$item['nickOperador'].'</td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm('.$item["idOperador"].')">
                        <i class="fa fa-pencil"></i>
                    </button>
                </form>
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="">
                    <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR('.$item['idOperador'].')">
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
?>