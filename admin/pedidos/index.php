<?php
include('../template/header.php');
?>
<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-sm-12 main-chart">
            <div class="border-head" style="display: none;">
                <h3 style="color: black" id="tIndex">Pedidos</h3>
            </div>
            <div class="border-head">
                <h3 id="title" style="color: black">Pedidos</h3>
            </div>
            <section>
                <button id="btnForm" class="btn btn-success" title="Nuevo" onclick="showForm()" style="cursor: pointer;"><i id="faIconF" class="fa fa-plus"></i></button>
                <a href="excel.php"><button class="btn btn-primary" style="cursor: pointer;"><i id="faIconF" class="fa fa-file-excel-o"></i></button></a>
                <a href="pdf.php"><button class="btn btn-danger" style="cursor: pointer;"><i id="faIconF" class="fa fa-file-pdf-o"></i></button></a>
                <section>
                    <div style="background-color: white;" id="form"></div>
                </section>
                <div id="table" class="content-panel table table-responsive">
                    <div class="form-group col-sm-12">
                        <form action="form-horizontal" method="POST" name="search_form" id="search_form" style="color: black">
                            <div class="form-group col-sm-1" style="margin-right: -5rem;">
                                <label class="control-label col-sm-1" for="search"><i class="fa fa-search"></i></label>
                            </div>
							<div class="col-sm-4">
							    <input class="form-control" size="50" type="search" name="search" id="search" placeholder="Ingrese su busqueda" onkeyup="searches();">
                            </div>
                            <div class="col-sm-1"  style="margin-right: -5rem;">
                                <label class="control-label col-sm-1"><i class="fa fa-cog"></i></label>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" id="c" onchange="searches();">
                                    <option value="">Selecciona Estado</option>
                                    <?php //if($especialidad){ foreach($especialidad as $es){ ?>
                                        <option value="1">Terminado</option>
                                        <option value="2">En Proceso</option>
                                        <option value="3">En Espera</option>
                                    <?php //}}?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div id="en_lista"></div>
                </div>
            </section>
            </div>
        </div>
    </section>
</section>
<script>
    $(document).ready(function(){
        
    });
</script>
<?php 
include('../template/footer.php');
?>