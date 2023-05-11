<?php
require_once ('../class/Operadores.php');
$op = Operadores::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
    <thead>
        <?php if(count($op)): ?>
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
    <tbody>
        <?php $i=1; foreach($op as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['nombreOperador']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['apellidosOperador']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['turnoOperador']; ?></td>
            <td style="text-transform: uppercase;"><?= $item['nickOperador']; ?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?php echo $item['idOperador'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?php echo $item['idOperador'];?>)">
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
            No hay Operadores agregados
        </p>
    </div>
<?php endif; ?>