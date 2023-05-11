<?php
    require_once '../class/Modelos.php';
    require_once '../class/Pedidos.php';
    require_once '../class/Productos.php';
    require_once '../class/Maquinas.php';
    require_once '../class/Operadores.php';
    session_start();

    $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
    if($id){
        $object = Productos::searchById($id);
        /*$materials = (Modelos::searchById(((new Pedidos())->searchByid((new Productos())->searchById($id)))->getIdModelo()))->getMateriales();
        var_dump($materials);*/
    }else{
        $object = new Productos();
    }
    $objectP = (new Pedidos())->getAll();
    $objectMq = (new Maquinas())->getAll();
    $objectO = (new Operadores())->getAll();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid black; box-shadow: 0px 0px 8px grey;">
            <form id="data" class="was-validated" style="margin-top: 2%; color: black;" enctype="multipart/form-data">
                <div class="row">
                <input type="hidden" name="idProducto" id="idProducto" value="<?= $object->getIdProducto()?>">
                <!--<input type="hidden" id="st" value="<?php //$object->getSistemasN()?>">-->
                <div class="col-sm-12" style="background-color: grey;">
					<img class="img-circle" src="../template/images/NavySeal.jpg" width="35" height="35"><b style="color: white; text-shadow: 0px 0px 0px black">NAVY<span style="color: black; text-shadow: 0px 0px 0px black"> SEAL</span></b>
				</div>
                <div class="col-sm-12">
                    <div class="col-sm-12 text-right"><h4 style="color: black; text-align: right;">Folio: <span style="color: red;" id="sfproduct"></span><!--<div id="folioP"></div>--></h4></div>
                </div>
                <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideA();" title="Ocultar/Mostrar">Datos principales <i class="fa fa-eye-slash" id="dA" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div class="form-group col-md-12 showA">
                        <div id="showModelsProduct"></div>
                    </div>
                    <div class="form-group col-md-4 showA" <?php if($_SESSION['privilegios'] > 3){ ?>style="display: none;"<?php }?>>
                        <label for="">Pedido</label>
                        <select class="form-control" name="idPedido" id="idPedido" onchange="showAllToProduct();">
                            <option value="">Selecciona Pedido</option>
                            <?php if($objectP){ foreach($objectP as $item){ if($id){ if($item['idPedido'] == $object->getIdPedido()){?>
                                <option value="<?= $item['idPedido']?>" <?php if($object->getIdPedido() == $item['idPedido']){echo "Selected";}?>><?= $item['modelo']?></option>
                            <?php }}else{ if($item['estadoPedido'] != 1){?>
                                <option value="<?= $item['idPedido']?>" <?php if($object->getIdPedido() == $item['idPedido']){echo "Selected";}?>><?= $item['modelo']?></option>
                            <?php }}}}?>
                        </select>
                    </div>
                    <div id="showClientData"></div>
                    <div id="showModelData"></div>
                    <div id="showModelMaterial"></div>
                    <div class="form-group col-sm-4 showA">
                        <label for="">Operador</label>
                        <select class="form-control" name="idOperador" id="idOperador" <?php if($_SESSION['privilegios'] > 3){ ?>style="display: none;"<?php }?>>
                            <option value="">Selecciona un operador</option>
                            <?php if($objectO){ foreach($objectO as $item){?>
                            <option value="<?= $item['idOperador']?>"<?php if($object->getIdOperador() == $item['idOperador']){ echo "Selected";}?>><?= $item['nombreOperador']." ".$item['apellidosOperador']?></option>
                            <?php }}?>
                        </select>
                        <?php if($_SESSION['privilegios'] > 3){ ?>
                            <input class="form-control" value="<?php if($objectO){ foreach($objectO as $item){ if($object->getIdOperador() == $item['idOperador']){ echo $item['nombreOperador']." ".$item['apellidosOperador'];}}}?>" disabled>
                        <?php }?>
                    </div>
                    <div class="form-group col-sm-4 showA">
                        <label for="">Maquina</label>
                        <select class="form-control" name="idMaquina" id="idMaquina" onchange="showMaqInfo();" <?php if($_SESSION['privilegios'] > 3){ ?>style="display: none;"<?php }?>>
                            <option value="">Selecciona una Maquina</option>
                            <?php if($objectMq){ foreach($objectMq as $item){?>
                            <option value="<?= $item['idMaquina']?>" <?php if($object->getIdMaquina() == $item['idMaquina']){ echo "Selected";}?>><?= $item['maquina']?></option>
                            <?php }}?>
                        </select>
                        <?php if($_SESSION['privilegios'] > 3){ ?>
                            <input class="form-control" value="<?php if($objectMq){ foreach($objectMq as $item){ if($object->getIdMaquina() == $item['idMaquina']){ echo $item['maquina'];}}}?>" disabled>
                        <?php }?>
                    </div>
                    <div id="showMaqInformation"></div>
                    <div class="form-group col-sm-12 showA">
                    <label for="">observaciones</label>
                    <div style="text-align: center;">
                    <textarea name="observaciones" id="observaciones" cols="100" rows="5" style="max-width: 100%; resize: none; overflow: scroll;" <?php if($_SESSION['privilegios'] > 3){ ?> readonly <?php }?>><?= $object->getObservaciones();?></textarea>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12">
                        <p style="background-color: yellow; opacity: 0.8; text-align: center; color: black; cursor: pointer; user-select: none;" onclick="hideB();" title="Ocultar/Mostrar">Datos de Producción <i class="fa fa-eye-slash" id="dB" style="cursor: pointer;" title="Ocultar/Mostrar"></i></p>
                        <hr color="black" size="1" width="100%">
                    </div>
                    <div id="showDataControls"></div>
                    <div class="col-sm-12">
                    <hr color="black" size="1" width="100%">
                    </div>
                    <div class="col-sm-12" style="background-color: grey; margin-bottom: 40px;">
					<p style="background-color: grey; opacity: 1; text-align: center; color: white; margin-top: 1%;" >NAVY SEAL S. DE R.L DE C.V.</p>
				    </div>
                    <div class="col-md-12 text-right py-2" style="margin-bottom: 2%;">
                        <?php if($_SESSION['privilegios'] < 4){?><button type="button" class="btn btn-success" onclick="saveData2();">Guardar</button><?php }?>
                        <button type="button" class="btn btn-danger" id="btnFormOp" onclick="<?php if($_SESSION['privilegios'] < 4){?>showForm<?php }else{ ?>showFormForOp<?php }?>();"><?php if($_SESSION['privilegios'] < 4){?>Cancelar<?php }else{ ?>Atras<?php }?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){ showDataCInProduct();showDataM();setSpf();getControlsToFormProduct();});
</script>