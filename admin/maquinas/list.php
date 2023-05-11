<?php
require_once ('../class/Maquinas.php');
$maq = Maquinas::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info tabla" style="color: black">
    <thead>
        <?php if(count($maq)): ?>
        <tr>
            <td>#</td>
            <td>Maquina</td>
            <td>Modelo</td>
            <td>Estado</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($maq as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['maquina']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['modelo']; ?></td>
            <td style="text-transform: capitalize;"><?php if($item['estadoM'] == 1){ echo "Perfecto"; }else{ echo "Detenida";}?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?= $item['idMaquina'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?= $item['idMaquina'];?>)">
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
            No hay Maquinas agregadas
        </p>
    </div>
<?php endif; ?>