<?php
    require_once '../class/Materiales.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Materiales::searchById($id);
    }else{
        $object = new Materiales();
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;" onsubmit="false">
                <div class="row">
                <input type="hidden" name="idCliente" value="<?= $object->getidMaterial()?>">
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
                        <label for="">Material</label>
                        <input class="form-control is-invalid" type="text" name="material" id="material" placeholder="Nombre del Material" style="text-transform: capitalize;" value="<?= $object->getMaterial();?>" onkeypress="return (event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 209 || event.charCode == 241 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || event.charCode == 243 || event.charCode == 250 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 || event.charCode == 211 || event.charCode == 218 || event.charCode == 32)" required>
                    </div>
                    <div class="form-group col-md-4 showA" style="display: none;">
                        <label for="">Torción</label>
                        <input class="form-control" type="text" name="torcion" id="torcion" placeholder="Torción" style="text-transform: capitalize;" readonly value="<?php if($id){ echo $object->getTorcion();}else{echo "s,z";}?>" required>
                    </div>
                    <div class="form-group col-md-4 showA" style="display: none;">
                        <label for="">Calibre</label>
                        <input class="form-control" type="text" name="calibre" id="calibre" placeholder="Calibre" style="text-transform: capitalize;" readonly value="<?php if($id){echo $object->getCalibre();}else{echo "20-30";}?>" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Cantidad</label>
                        <input class="form-control" type="number" min="1" maxlength="3" max="150" name="cantidad" id="cantidad" placeholder="Cantidad" style="text-transform: capitalize;" value="<?= $object->getCantidad();?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value >= 151){this.value = this.value.slice(0, (maxLength-1))}" required>
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