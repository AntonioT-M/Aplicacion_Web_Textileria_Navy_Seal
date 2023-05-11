<?php
    require_once '../class/Pedidos.php';
    require_once '../class/Clientes.php';
    require_once '../class/Modelos.php';

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Pedidos::searchById($id);
        $objectMT = Modelos::searchById($object->getIdModelo());
    }else{
        $object = new Pedidos();
    }
    $objectC = Clientes::getAll();
    $objectM = Modelos::getAll();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;" onsubmit="false">
                <div class="row">
                <input type="hidden" name="idPedido" id="idPedido" oninput="showModels();" value="<?= $object->getIdPedido()?>">
                <!--<input type="hidden" id="st" value="<?php //$object->getSistemasT()?>">-->
                <div class="col-sm-12" style="background-color: grey;">
					<img class="img-circle" src="../template/images/NavySeal.jpg" width="35" height="35"><b style="color: white; text-shadow: 0px 0px 0px black">NAVY<span style="color: black; text-shadow: 0px 0px 0px black"> SEAL</span></b>
				</div>
                <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideA();" title="Ocultar/Mostrar">Datos del Cliente <i class="fa fa-eye-slash" id="dA" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-md-4 showA">
                        <label for="">Cliente</label>
                        <select class="form-control" name="idCliente" id="idCliente" onchange="showDataC();">
                            <option value="">Selecciona Cliente</option>
                            <?php if($objectC){ foreach($objectC as $item){?>
                            <option value="<?= $item['idCliente']?>" <?php if($object->getIdCliente() == $item['idCliente']){echo "Selected";}?>><?= $item['nombreC']?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div id="showClientData"></div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideB();" title="Ocultar/Mostrar">Datos del pedido <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-md-12 showB">
                        <div id="imgModel"></div>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Talla</label>
                        <select class="form-control" name="talla" id="talla" onchange="showModels();" required>
                            <option value="">Seleccione Talla</option>
                            <option value="Extra Chica" <?php if($id){if($objectMT->getTalla() == "Extra Chica"){ echo 'Selected';}}?>>Extra Chica</option>
                            <option value="Chica" <?php if($id){if($objectMT->getTalla() == "Chica"){ echo 'Selected';}}?>>Chica</option>
                            <option value="Mediana" <?php if($id){if($objectMT->getTalla() == "Mediana"){ echo 'Selected';}}?>>Mediana</option>
                            <option value="Grande" <?php if($id){if($objectMT->getTalla() == "Grande"){ echo 'Selected';}}?>>Grande</option>
                            <option value="Extra Grande" <?php if($id){if($objectMT->getTalla() == "Extra Grande"){ echo 'Selected';}}?>>Extra Grande</option>
                            <option value="Unitalla" <?php if($id){if($objectMT->getTalla() == "Unitalla"){ echo 'Selected';}}?>>Unitalla</option>
                            <option value="Muestra" <?php if($id){if($objectMT->getTalla() == "Muestra"){ echo 'Selected';}}?>>Muestra</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Modelo</label>
                        <div id="showModels"></div>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Cantidad</label>
                        <input class="form-control" type="number" maxlength="4" minlength="1" max="2001" min="1" name="cantidad" id="cantidad" placeholder="Cantidad De Piezas a Producir" value="<?= $object->getCantidad();?>" onkeypress=" return (event.charCode >= 48 && event.charCode <= 57)" oninput="if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}else if(this.value >= this.max){this.value = this.value.slice(0, (maxLength-1))}else if(this.value < this.min){this.value = this.value.slice(0, (minLength-1))}" required>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">¿Medidas definidas?</label>
                        <div class="centered">
                        <span>Si: <input type="radio" onchange="checkDM();" value="1" name="medidas" <?php if($id){ if($object->getAnchoI() != "N/A" && $object->getLargoI() != "N/A"){ echo "checked";}}?>></span>
                        <span>No: <input type="radio" onchange="checkDM();" value="2" name="medidas" <?php if($id){ if($object->getAnchoI() == "N/A" && $object->getLargoI() == "N/A"){ echo "checked";}}?>></span>
                        </div>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Ancho</label>
                        <input class="form-control sistemasT" type="text" name="anchoI" id="anchoI" maxlength="" minlength="1" max="" min="1" placeholder="Ancho Definido" onchange="" style="text-transform: capitalize;" value="<?= $object->getAnchoI();?>" onkeypress=" return (event.charCode >= 48 && event.charCode <= 57)" readonly required>
                        <input class="form-control" type="hidden" name="anchoIBD" id="anchoIBD" style="text-transform: capitalize;" placeholder="" value="<?php if($id){ echo $object->getAnchoI();}?>" disabled>
                    </div>
                    <div class="form-group col-md-4 showB">
                        <label for="">Largo</label>
                        <input class="form-control sistemasT" type="text" name="largoI" id="largoI" maxlength="" minlength="1" max="" min="1" placeholder="Largo Definido" onchange="" style="text-transform: capitalize;" value="<?= $object->getLargoI();?>" onkeypress=" return (event.charCode >= 48 && event.charCode <= 57)" readonly required>
                        <input class="form-control" type="hidden" name="largoIBD" id="largoIBD" style="text-transform: capitalize;" placeholder="" value="<?php if($id){ echo $object->getLargoI();}?>" disabled>
                    </div>
                    <?php if($id){?>
                    <div class="form-group col-md-4 showB" style="display: none;">
                        <label for="">Estatus</label>
                        <select class="form-control" name="estatusAP" id="estatusAP" onchange="" required>
                            <option value="">Seleccione Estatus</option>
                            <option value="2" <?php if($object->getEstatusA() == 2){ echo 'Selected';}?>>En Espera</option>
                            <option value="1" <?php if($object->getEstatusA() == 1){ echo 'Selected';}?>>Revisado</option>
                        </select>
                    </div>
                    <?php }else{?>
                        <input class="form-control" type="hidden" name="estatusAP" id="estatusAP" style="text-transform: capitalize;" placeholder="Tipo de Cliente" value="1" readonly>
                    <?php }?>
                    <?php if($id){?>
                    <div class="form-group col-md-4 showB" style="display: none;">
                        <label for="">Estatus</label>
                        <select class="form-control" name="estatusBP" id="estatusBP" onchange="" required>
                            <option value="">Seleccione Estatus</option>
                            <option value="2" <?php if($object->getEstatusB() == 2){ echo 'Selected';}?>>En Espera</option>
                            <option value="1" <?php if($object->getEstatusB() == 1){ echo 'Selected';}?>>Revisado</option>
                        </select>
                    </div>
                    <?php }else{?>
                        <input class="form-control" type="hidden" name="estatusBP" id="estatusBP" style="text-transform: capitalize;" placeholder="Tipo de Cliente" value="2" readonly>
                    <?php }?>
                    <?php if($id){?>
                    <div class="form-group col-md-4 showB">
                        <label for="">Estado del pedido</label>
                        <select class="form-control" name="estadoP" id="estadoP" onchange="" disabled required>
                            <option value="">Seleccione Estado</option>
                            <option value="3" <?php if($object->getEstadoPedido() == 3){ echo 'Selected';}?>>En Espera</option>
                            <option value="2" <?php if($object->getEstadoPedido() == 2){ echo 'Selected';}?>>En Proceso</option>
                            <option value="1" <?php if($object->getEstadoPedido() == 1){ echo 'Selected';}?>>Terminado</option>
                        </select>
                        <input class="form-control" type="hidden" name="estadoP" id="estadoP" style="text-transform: capitalize;" placeholder="Tipo de Cliente" value="<?php if($id){ echo $object->getEstadoPedido();}?>" readonly>
                    </div>
                    <?php }else{?>
                        <input class="form-control" type="hidden" name="estadoP" id="estadoP" style="text-transform: capitalize;" placeholder="Tipo de Cliente" value="3" readonly>
                    <?php }?>
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
        showDataC();checkDM();showModels();
    });
</script>