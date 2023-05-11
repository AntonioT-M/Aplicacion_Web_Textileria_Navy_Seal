<?php
require_once ('../class/Administradores.php');
$admin = Administradores::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
    <thead>
        <?php if(count($admin)): ?>
        <tr>
            <td>#</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Cargo</td>
            <td>Nick</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($admin as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['nombreAdmin']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['apellidosAdmin']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['cargo']; ?></td>
            <td style="text-transform: uppercase;"><?= $item['nickAdmin']; ?></td>
            <td>
            <?php if($item['privilegiosAdmin'] != 0){?>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?php echo $item['idAdministrador'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            <?php };?>
            </td>
            <td>
            <?php if($item['privilegiosAdmin'] != 0){?>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?php echo $item['idAdministrador'];?>)">
                    <i class="fa fa-trash"></i>
                </button>
                <?php };?>
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
            No hay Administradores agregados
        </p>
    </div>
<?php endif; ?>