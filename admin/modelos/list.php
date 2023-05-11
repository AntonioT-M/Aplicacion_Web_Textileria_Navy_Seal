<?php
require_once ('../class/Modelos.php');
$mod = Modelos::getAll();
?>
<table class="table table-bordered table-striped table-condesed" id="hidden-table-info" style="color: black">
    <thead>
        <?php if(count($mod)): ?>
        <tr>
            <td>#</td>
            <td>Imagen</td>
            <td>Modelo</td>
            <td>Talla</td>
            <td>Código</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($mod as $item): ?>
        <tr>
            <td><?= $i++;?></td>
            <td style="text-transform: capitalize;"><img height="80" width="80" style="transform: rotate(11deg);" src="<?= $item['imgModelo']; ?>" alt="Imagen del modelo"></td>
            <td style="text-transform: capitalize;"><?= $item['modelo']; ?></td>
            <td style="text-transform: capitalize;"><?= $item['talla']; ?></td>
            <td style="text-transform: uppercase;"><?= $item['codigo']; ?></td>
            <td>
                <button id="btnForm" type="button" class="btn btn-primary" title="Actualizar" onclick="showForm(<?php echo $item['idModelo'];?>)">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button id="btnDelete" class="btn btn-danger" type="button" title="Eliminar" onclick="deleteR(<?php echo $item['idModelo'];?>)">
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
            No hay Modelos agregados
        </p>
    </div>
<?php endif; ?>