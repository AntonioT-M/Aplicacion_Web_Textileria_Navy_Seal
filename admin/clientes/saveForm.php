<?php
    require_once '../class/Clientes.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Clientes::searchById($id);
    }else{
        $object = new Clientes();
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;">
                <div class="row">
                <input type="hidden" name="idCliente" value="<?= $object->getIdCliente()?>">
                <input type="hidden" name="rs" id="rs" value="<?= $object->getRSocial()?>" disabled>
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
                        <label for="">Nombre</label>
                        <input class="form-control is-invalid" type="text" name="nombreC" id="nombreC" placeholder="Nombre completo de la empresa/persona" style="text-transform: capitalize;" value="<?= $object->getNombreC();?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Tipo</label>
                        <select class="form-control" name="tipo" id="tipoC" onchange="typeC();" required>
                            <option value="">Seleccione Tipo</option>
                            <option value="Formal" <?php if($object->getTipo() == "Formal"){ echo 'Selected';}?>>Formal</option>
                            <option value="Informal" <?php if($object->getTipo() == "Informal"){ echo 'Selected';}?>>Informal</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Razón Social</label>
                        <input class="form-control" type="text" name="rSocial" id="rSocial" placeholder="Razón Social" style="text-transform: capitalize;" value="<?= $object->getRSocial();?>" required>
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
$(document).ready(function(){typeC();})
</script>