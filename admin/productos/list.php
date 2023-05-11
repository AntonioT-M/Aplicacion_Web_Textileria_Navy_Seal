<?php
require_once ('../class/Productos.php');
session_start();
$prods = Productos::getAll();
if($_SESSION['privilegios'] == 4){
    for($i = 0; count($prods) > $i; $i++){
        if($prods[$i]['nombreOperador'] != $_SESSION['nombre'] && $prods[$i]['apellidosOperador'] != $_SESSION['apellidos']){
            unset($prods[$i]);
        }
    }
}
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
    <thead>
        <?php if(count($prods)): ?>
        <tr>
            <td>#</td>
            <td>Imagen</td>
            <td>Modelo</td>
            <td>Talla</td>
            <td>Cantidad</td>
            <td>Maquina</td>
            <td>Operador</td>
            <td>Estado</td>
            <td></td>
            <?php if($_SESSION['privilegios'] < 4){?>
            <td></td>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($prods as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><img height="80" width="80" style="transform: rotate(11deg);" src="<?= '../modelos/'.$item['imgModelo']; ?>" alt="Imagen del modelo"></td>
            <td style="text-transform: capitalize;"><?= $item['modelo']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['talla']; ?></td>
            <td style="text-transform: uppercase;"><?= $item['cantidad']; ?></td>
            <td style="text-transform: uppercase;"><?= $item['maquina']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['nombreOperador']." ".$item['apellidosOperador'][1]."."; ?></td>
            <td style="text-transform: capitalize;"><?php if($item['estadoPedido'] == 3){echo "En espera"; }else if($item['estadoPedido'] == 2){ echo "En proceso"; }else if($item['estadoPedido'] == 1){ echo "Terminado";}?></td>
            <td>
                <button id="btnFormOp" type="button" class="btn btn-primary" title="Actualizar" onclick="<?php if($_SESSION['privilegios'] < 4){?>showForm<?php }else{?>showFormForOp<?php }?>(<?php echo $item['idProducto'];?>)">
                    <i class="<?php if($_SESSION['privilegios'] < 4){?>fa fa-pencil<?php }else{ ?>fa fa-gear<?php }?>" ></i>
                </button>
            </td>
            <?php if($_SESSION['privilegios'] < 4){?>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?php echo $item['idProducto'];?>)">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
            <?php }?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</section>
<?php else: ?>
    <div class="col-md-12">
        <p class="centered" style="font-size: 17px; border-left: 10px solid red; border-right: 10px solid red;">
            No hay Productos agregados
        </p>
    </div>
<?php endif; ?>