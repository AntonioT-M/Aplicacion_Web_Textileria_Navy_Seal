<?php
require_once ('../class/Clientes.php');
$cl = Clientes::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info tabla" style="color: black">
    <thead>
        <?php if(count($cl)): ?>
        <tr>
            <td>#</td>
            <td>Nombre</td>
            <td>Razón Social</td>
            <td>Tipo</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($cl as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><?= $item['nombreC']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['rSocial']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['tipo']; ?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?php echo $item['idCliente'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?php echo $item['idCliente'];?>)">
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
            No hay Clientes agregados
        </p>
    </div>
<?php endif; ?>