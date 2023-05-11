<?php
session_start();
if(!isset($_SESSION['privilegios'])){
  header('Location: ../login.php');
} else if($_SESSION['privilegios'] < 0 && $_SESSION['privilegios'] > 4){
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>CPANEL</title>

  <!-- Favicons -->
  <link href="template/images/NavySeal.jpg" rel="icon">
  <link href="template/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Bootstrap core CSS -->
  <link href="template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="template/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="template/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this vendor/template -->
  <link href="template/css/style.css" rel="stylesheet">
  <link href="template/css/style-responsive.css" rel="stylesheet">
  <script src="template/lib/chart-master/Chart.js"></script>
    <!--Mis importaciones-->
  <script src="template/js/jquery.min.js"></script>
  <script src="template/js/popper.min.js"></script>
  <script src="template/js/bootstrap.min.js"></script>
  <script src="template/js/bootstrap-confirmation.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body oncontextmenu="return false" onkeydown="return false">
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Barra de navegación"></div>
      </div>
      <!--logo start-->
      <a href="" class="logo"><img class="img-circle" style="opacity: .8989;" src="template/images/NavySeal.jpg" width="50" height="50"><b>NAVY<span>SEAL</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">

      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li title="Cerrar sesion" onclick="logout()" style="cursor: pointer;"><a class="logout"><i class="fa fa-sign-out"></i></a></li>
        </ul>
        <!--<ul class="nav pull-right top-menu">
          <li title="y"><a class="logout" href="../index.php" style="background-color: blue;"><i class="fa fa-eye"></i></a></li>
        </ul>-->         
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse " style="background: #f1f2f7;">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <!--<p class="centered"><a href="usuarios/miPerfil.php"><img src="usuarios/<?php //if(isset($_SESSION['urlAvatar'])){ echo $_SESSION['urlAvatar'];}?>" class="img-circle" width="80"></a></p>-->
          <h5 class="centered" style="color: black;"><?php //if(isset($_SESSION['nombre'])){ echo $_SESSION['nombre'];}?></h5>
          <li class="mt">
            <a class="active" href="">
              <i class="fa fa-dashboard"></i>
              <span>Escritorio</span>
              </a>
          </li>
          <?php if($_SESSION['privilegios'] < 3){?><li class="sub-menu">
            <a href="">
              <i class="fa fa-group"></i>
              <span>Fuerza de trabajo</span>
              </a>
            <ul class="sub">
              <li><a href="administradores/index.php">Administradores</a></li>
              <li><a href="operadores/index.php">Operadores</a></li>
            </ul>
          </li>
          <!--<li class="sub-menu">
            <a href="">
              <i class="fa fa-group"></i>
              <span></span>
              </a>
              <ul class="sub">
              <li><a href=""></a></li>
              <li><a href=""></a></li>
              <li><a href=""></a></li>
            </ul>
          </li>-->
          <li class="sub-menu">
              <a href="clientes/index.php">
                <i class="fa fa-book"></i>
                <span>Clientes</span>
                </a>
            </li>
            <li class="sub-menu">
              <a href="pedidos/index.php">
                <i class="fa fa-folder"></i>
                <span>Pedidos</span>
                </a>
            </li><?php }?>
            <!--<ul class="sub">
              <li><a href="grids.html">Grids</a></li>
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="todo_list.html">Todo List</a></li>
              <li><a href="dropzone.html">Dropzone File Upload</a></li>
              <li><a href="inline_editor.html">Inline Editor</a></li>
              <li><a href="file_upload.html">Multiple File Upload</a></li>
            </ul>-->
          <!--</li> CHECK THIS IF SOMETHING IS WRONG-->
          <li class="sub-menu">
            <a href="">
              <i class="fa fa-gears"></i>
              <span>Área de Producción</span>
          </a>
            <ul class="sub">
            <?php if($_SESSION['privilegios'] < 4){ if($_SESSION['privilegios'] != 3){?>
              <li><a href="maquinas/index.php">Maquinas</a></li>
              <li><a href="materiales/index.php">Materiales</a></li>
              <?php }?>
              <li><a href="modelos/index.php">Modelos</a></li><?php }?>
              <?php if($_SESSION['privilegios'] != 3){?>
              <li><a href="productos/index.php">Productos</a></li>
              <?php }?>
            </ul>
          </li>
          <!--<li class="sub-menu">
            <a href="destinos/index.php">
              <i class="fa fa-credit-card"></i>
              <span></span>
            </a>
            <ul class="sub">
              <li><a href="Beca"></a></li>
              <li><a href="SolBecas"></a></li>
              <li><a href="AutBecas"></a></li>
              <li><a href="contactform.html">Contact Form</a></li>
            </ul>
          </li>-->
          <!--<li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>Charts</span>
              </a>
            <ul class="sub">
              <li><a href="morris.html">Morris</a></li>
              <li><a href="chartjs.html">Chartjs</a></li>
              <li><a href="flot_chart.html">Flot Charts</a></li>
              <li><a href="xchart.html">xChart</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room</span>
              </a>
            <ul class="sub">
              <li><a href="lobby.html">Lobby</a></li>
              <li><a href="chat_room.html"> Chat Room</a></li>
            </ul>
          </li>
          <li>
            <a href="google_maps.html">
              <i class="fa fa-map-marker"></i>
              <span>Google Maps </span>
              </a>
          </li>-->
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">
        <div class="row mt">
          <div class="col-sm-12 main-chart">
            <section>
              <div class="col-sm-12">
                <div class="row">
                  <div class="row mt">
                      <div class="col-sm-12 main-chart">
                      <!--div class="border-head">
                          <h3 id="title">Reportes</h3>
                      </div>
                      <section>
                          <section>
                              <div style="background-color: white;" id="form"></div>
                          </section>-->
                          <!--<div id="table" class="content-panel table table-responsive">
                              <div class="form-group col-sm-12">
                                <div class="col-sm-2">
                                <form action="Reportes/ExcelA" method="POST" name="search_form" id="search_form">
                                    <button id="btnForm" class="btn btn-primary" onclick="" style="cursor: pointer;"><i id="faIconF" class="fa fa-plus"></i>Alumnos</button>
                                </form>
                                </div>
                                <div class="col-sm-2">
                                <form action="Reportes/ExcelC" method="POST" name="search_form" id="search_form">
                                    <button id="btnForm" class="btn btn-primary" onclick="" style="cursor: pointer;"><i id="faIconF" class="fa fa-plus"></i>Cursos</button>
                                </form>
                                </div>
                                <div class="col-sm-2">
                                <form action="Reportes/ExcelI" method="POST" name="search_form" id="search_form">
                                    <button id="btnForm" class="btn btn-primary" onclick="" style="cursor: pointer;"><i id="faIconF" class="fa fa-plus"></i>Instructores</button>
                                </form>
                                </div>
                              </div>
                              <div id="en_lista"></div>
                          </div>-->
                      </section>
                      </div>
                  </div>
                        <div class="row mt">
                          <div class="col-sm-12 main-chart">
                          <section>
                          <?php if($_SESSION['privilegios'] < 3){?>
                                <div class="content-panel table table-responsive">
                                  <table class="table table-bordered table-striped table-condensed" id="hidden-table-info" style="color: black; user-select: none;">
                                  <caption class="centered" style="color: black; user-select: none;">Código QR para reportes</caption>
                                    <thead>
                                      <tr>
                                        <td>Operadores</td>
                                        <td>Clientes</td>
                                        <td>Maquinas</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><img src="operadores/qr/ROP.png" alt="Codigo QR"></td>
                                        <td><img src="clientes/qr/RC.png" alt="Codigo QR"></td>
                                        <td><img src="maquinas/qr/RMAQ.png" alt="Codigo QR"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table class="table table-bordered table-striped table-condensed" id="hidden-table-info" style="color: black; user-select: none;">
                                    <thead>
                                      <tr>
                                        <td>Materiales</td>
                                        <td>Modelos</td>
                                        <td>Pedidos</td>
                                        <td>Producción</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><img src="materiales/qr/RMAT.png" alt="Codigo QR"></td>
                                        <td><img src="modelos/qr/RMOD.png" alt="Codigo QR"></td>
                                        <td><img src="pedidos/qr/RPED.png" alt="Codigo QR"></td>
                                        <td><img src="productos/qr/RPROD.png" alt="Codigo QR"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <?php }else{?>
                                  <div class="col-sm-12"> 
                                    <img class=""  style="opacity: 0.2; margin: auto; display: block; width: 100%; height: 100%; max-height: 850px; max-width: 500px; z-index: 1;" src="template/images/NavySeal.jpg">
                                  </div>
                                  <div class="col-sm-12">
                                    <h2 style="text-align: center; z-index: 3;">Bienvenid@ <?php if(isset($_SESSION['nombre'])){ echo $_SESSION['nombre']." ".$_SESSION['apellidos'];}?></h2>
                                  </div>
                                  <?php }?>
                          </section>
                  <!--<div class="col-sm-12"> 
                    <img class=""  style="opacity: 0.2; margin: auto; display: block; width: 100%; height: 100%; max-height: 850px; max-width: 500px; z-index: 1;" src="template/images/NavySeal.jpg">
                  </div>
                  <div class="col-sm-12">
                    <h2 style="text-align: center; z-index: 3;">Bienvenid@ <?php //if(isset($_SESSION['nombreAdmin'])){ echo $session->get('nombreAdmin')." ".$session->get('apellidoP'); }?></h2>
                  </div>-->
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      </section>

      <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>NAVY SEAL S. DE R.L DE C.V</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template <a href=""><strong></strong></a>
        </div>
        <a href="index.php" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="template/lib/jquery/jquery.min.js"></script>
  <script src="template/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="template/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="template/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="template/lib/jquery.scrollTo.min.js"></script>
  <script src="template/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="template/lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="template/lib/common-scripts.js"></script>
  <script type="text/javascript" src="template/lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="template/lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="template/lib/sparkline-chart.js"></script>
  <script src="template/lib/zabuto_calendar.js"></script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }

    function logout(){
	var d = "";
	var h = new Date().getHours();;
	if(h >= 1 && h <= 11){
		d = "🌄 Que tenga un buen dia!";
	}else if(h >= 12 && h <= 18){
		d = "🌞 Que tenga bonita tarde!";
	}else if(h >= 19 && h <= 23){
		d = "🌚 Que tenga una buena noche!";
	}
	Swal.fire({
		title:'¿Desea salir?',
		icon:'question',
		showCancelButton: true,
		confirmButtonColor:'#3085d6',
		cancelButtonColor:'#d33',
		confirmButtonText:'Aceptar'
	}).then((result) => {
		if(result.isConfirmed){
			Swal.fire({
				title: d,
				icon: 'success',
				showConfirmButton: false,
        allowOutsideClick: false,
				timer: 1300,
				timerProgressBar: true,
				didOpen: () =>{
					Swal.showLoading();
				}
			}).then((result) => {
				if(result.dismiss === Swal.DismissReason.timer){
					window.location.href="../lib/logout";
				}
			});
		}else if(result.dismiss === Swal.DismissReason.cancel){
			
		}
	})
}
  </script>
</body>

</html>