<?php
require_once ('../class/Materiales.php');
$mat = Materiales::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info tabla" style="color: black">
    <thead>
        <?php if(count($mat)): ?>
        <tr>
            <td>#</td>
            <td>Material</td>
            <td>Torcion</td>
            <td>Calibre</td>
            <td>Cantidad</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($mat as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['material']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['torcion']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['calibre']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['cantidad']; ?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?= $item['idMaterial'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?= $item['idMaterial'];?>)">
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
            No hay Materiales agregados
        </p>
    </div>
<?php endif; ?>