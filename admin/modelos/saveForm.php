<?php
    require_once '../class/Modelos.php';
    require_once '../class/Materiales.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Modelos::searchById($id);
    }else{
        $object = new Modelos();
    }
    $objectM = new Materiales();
    $objectM = $objectM->getAll();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;" enctype="multipart/form-data">
                <div class="row">
                <input type="hidden" name="idModelo" id="idModelo" value="<?= $object->getIdModelo()?>">
                <!--<input type="hidden" id="st" value="<?php //$object->getSistemasN()?>">-->
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
                    <div class="form-group col-md-12 showA">
                    <div>
                        <label for="">Imagen del Módelo</label>
                        <div id="preview" style="text-align: center; max-width: 100%; width: 100%; height: 100%; max-height: 100%; line-height: 20px;">
                            <img id="show" src="<?php if($object){echo $object->getImgModelo();}?>" height="200" width="200" alt=" " /><!--<input type="file" name="url" value="<?php //echo $producto->getUrl() ?>">-->
                        </div>
                        <div>
                            <span> 
                                <input class="form-control" type="file" id="file" accept="image/*" capture="camera" onchange="showimg()" name="url" value="<?php if($object){echo $object->getImgModelo();}?>">
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Modelo</label>
                        <input class="form-control is-invalid" type="text" name="modelo" onchange="setNick();" id="modelo" placeholder="Nombre del modelo" style="text-transform: capitalize;" value="<?= $object->getModelo();?>" onkeypress="return (event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 209 || event.charCode == 241 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || event.charCode == 243 || event.charCode == 250 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 || event.charCode == 211 || event.charCode == 218 || event.charCode == 32 || event.charCode >= 48 && event.charCode <= 57)" required>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Talla</label>
                        <select class="form-control" name="talla" id="talla" required>
                            <option value="">Seleccione Talla</option>
                            <option value="Extra Chica" <?php if($object->getTalla() == "Extra Chica"){ echo 'Selected';}?>>Extra Chica</option>
                            <option value="Chica" <?php if($object->getTalla() == "Chica"){ echo 'Selected';}?>>Chica</option>
                            <option value="Mediana" <?php if($object->getTalla() == "Mediana"){ echo 'Selected';}?>>Mediana</option>
                            <option value="Grande" <?php if($object->getTalla() == "Grande"){ echo 'Selected';}?>>Grande</option>
                            <option value="Extra Grande" <?php if($object->getTalla() == "Extra Grande"){ echo 'Selected';}?>>Extra Grande</option>
                            <option value="Unitalla" <?php if($object->getTalla() == "Unitalla"){ echo 'Selected';}?>>Unitalla</option>
                            <option value="Muestra" <?php if($object->getTalla() == "Muestra"){ echo 'Selected';}?>>Muestra</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Codigo</label>
                        <input class="form-control" type="text" name="codigo" onchange="" id="codig" placeholder="Código para producir" style="text-transform: uppercase;" value="<?= $object->getCodigo();?>" onkeypress="return (event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode >= 48 && event.charCode <= 57)" required>
                    </div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideB();" title="Ocultar/Mostrar">Datos para producir <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <?php
                    if($object){
                        $materials = explode(',', $object->getMateriales());
                    ?>
                    <input type="hidden" value="$materials" disabled>
                    <?php
                        $nm = 0;
                        for($i = 0; count($materials) > $i;$i++){
                            $nm++;
                        }
                    }
                    ?>
                    <div class="form-group col-md-4 showB">
                        <label for="">Materiales Necesarios</label>
                        <input class="form-control" type="number" placeholder="materiales" name="nm" id="nm" min="1" max="5" maxlength="1" minlength="1" onchange="" style="text-transform: capitalize;" value="<?php if($object){echo $nm;}?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value >= 6){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < 1){this.value = this.value.slice(0, (minLength-1))} getMaterialsToModels();" required>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="showFormMaterial"></div>
                    </div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12" style="background-color: grey; margin-bottom: 40px;">
					<p style="background-color: grey; opacity: 1; text-align: center; color: white; margin-top: 1%;" >NAVY SEAL S. DE R.L DE C.V.</p>
				    </div>
                    <div class="col-md-12 text-right py-2" style="margin-bottom: 2%;">
                        <button type="button" class="btn btn-success" onclick="saveData2();">Guardar</button>
                        <button type="button" class="btn btn-danger" onclick="showForm();">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){ getMaterialsToModels();});
</script>