<?php
require_once ('../class/Pedidos.php');
$pds = Pedidos::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info tabla" style="color: black">
    <thead>
        <?php if(count($pds)): ?>
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
    <tbody>
        <?php $i=1; foreach($pds as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['nombreC']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['modelo']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['talla']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['cantidad']; ?></td>
            <td style="text-transform: capitalize;"><?php if($item['estadoPedido'] == 1){ echo "Terminado"; }
            else if($item['estadoPedido'] == 2){ echo "En Proceso";}else if($item['estadoPedido'] == 3){echo "En Espera";}?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?= $item['idPedido'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?= $item['idPedido'];?>)">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</section>
<?php else: ?>
    <div class="col-md-12">
        <p class="centered" style="font-size: 17px; border-left: 10px solid red; border-right: 10px solid red;">
            No hay Pedidos agregadoss
        </p>
    </div>
<?php endif; ?>