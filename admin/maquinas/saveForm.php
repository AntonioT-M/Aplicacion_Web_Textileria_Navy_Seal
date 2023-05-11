<?php
    require_once '../class/Maquinas.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Maquinas::searchById($id);
    }else{
        $object = new Maquinas();
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;" onsubmit="false">
                <div class="row">
                <input type="hidden" name="idCliente" value="<?= $object->getIdMaquina()?>">
                <input type="hidden" id="st" value="<?= $object->getSistemasT()?>">
                <div class="col-sm-12" style="background-color: grey;">
					<img class="img-circle" src="../template/images/NavySeal.jpg" width="35" height="35"><b style="color: white; text-shadow: 0px 0px 0px black">NAVY<span style="color: black; text-shadow: 0px 0px 0px black"> SEAL</span></b>
				</div>
                <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideA();" title="Ocultar/Mostrar">Datos principales <i class="fa fa-eye-slash" id="dA" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Maquina</label>
                        <input class="form-control is-invalid" type="text" name="maquina" id="maquina" placeholder="Nombre de Maquina" style="text-transform: capitalize;" value="<?= $object->getMaquina();?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Modelo</label>
                        <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Modelo de Maquina" style="text-transform: capitalize;" value="<?= $object->getModelo();?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Sistemas</label>
                        <select class="form-control sistemasSelectM" id="" onchange="putSistemsOnI();">
                            <option value="">Selecciona Sistemas</option>
                            <option value="1">Todos</option>
                            <option value="2">Pares</option>
                            <option value="3">Nones</option>
                            <option value="4">Especificos</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Sistemas</label>
                        <input class="form-control sistemasT" type="text" onchange="getSistemsOfI();" name="sistemasT" id="" placeholder="Sistemas que tiene" style="text-transform: capitalize;" value="<?= $object->getSistemasT();?>" readonly required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Estado</label>
                        <select class="form-control" name="tipo" id="tipoC" required>
                            <option value="">Seleccione Estado</option>
                            <option value="1" <?php if($object->getEstadoM() == 1){echo "Selected";}?>>Perfecto</option>
                            <option value="2" <?php if($object->getEstadoM() == 2){echo "Selected";}?>>Detenida</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12" style="background-color: grey; margin-bottom: 40px;">
					<p style="background-color: grey; opacity: 1; text-align: center; color: white; margin-top: 1%;" >NAVY SEAL S. DE R.L DE C.V.</p>
				    </div>
                    <div class="col-md-12 text-right py-2" style="margin-bottom: 2%;">
                        <button type="button" class="btn btn-success" onclick="saveData();">Guardar</button>
                        <button type="button" class="btn btn-danger" onclick="showForm();">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        getSistemsOfI();
    });
</script>