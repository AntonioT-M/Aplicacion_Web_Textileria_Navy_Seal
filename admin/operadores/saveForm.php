<?php
    require_once '../class/Operadores.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Operadores::searchById($id);
    }else{
        $object = new Operadores();
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;">
                <div class="row">
                <input type="hidden" name="idOperador" value="<?= $object->getIdOperador()?>">
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
                        <input class="form-control is-invalid" type="text" name="nombreOperador" onchange="setNick();" id="nombre" placeholder="Nombre completo" style="text-transform: capitalize;" value="<?= $object->getNombreOperador();?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Apellidos</label>
                        <input class="form-control" type="text" name="apellidosOperador" onchange="setNick();" id="apellidos" placeholder="Apellido/s" style="text-transform: capitalize;" value="<?= $object->getApellidosOperador();?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Turno</label>
                        <select class="form-control" name="cargo" id="cargo" required>
                            <option value="">Seleccione turno</option>
                            <option value="DIA" <?php if($object->getTurnoOperador() == "DIA"){ echo 'Selected';}?>>DIA</option>
                            <option value="NOCHE" <?php if($object->getTurnoOperador() == "NOCHE"){ echo 'Selected';}?>>NOCHE</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideB();" title="Ocultar/Mostrar">Datos de acceso <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Nick</label>
                        <input class="form-control" type="text" placeholder="Nick" name="nickOperador" id="nick" style="text-transform: uppercase;" value="<?= $object->getNickOperador();?>" readonly required>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Password</label>
                        <input class="form-control" type="password" placeholder="********" name="passwordOperador" value="<?= $object->getPasswordOperador();?>" required>
                    </div>
                    <div class="form-group col-md-4 showB" style="display: none;">
                        <label for="">Privilegios</label>
                        <input class="form-control" type="text" id="privilegios" name="privilegiosOperador" value="<?php if($id){echo $object->getPrivilegiosOperador();}else{ echo "4";}?>" readonly required>
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
</script>