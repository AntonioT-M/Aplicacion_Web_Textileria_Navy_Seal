<?php 
session_start();
if(!isset($_SESSION['privilegios'])){
  header('Location: ../../login.php');
} else if($_SESSION['privilegios'] < 0 && $_SESSION['privilegios'] > 4){
  header('Location: ../:./login.php');
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
  <link href="../template/images/NavySeal.jpg" rel="icon">
  <link href="../template/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Bootstrap core CSS -->
  <link href="../template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../template/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="../template/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this vendor/template -->
  <link href="../template/css/style.css" rel="stylesheet">
  <link href="../template/css/style-responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="template/node_modules/sweetalert2/dist/sweetalert2.min.css">
  <script src="../template/lib/chart-master/Chart.js"></script>
    <!--Mis importaciones-->
  <script src="../template/js/jquery.min.js"></script>
  <script src="../template/js/popper.min.js"></script>
  <script src="../template/js/bootstrap.min.js"></script>
  <script src="../template/js/bootstrap-confirmation.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body oncontextmenu="return false" id="body">
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
      <a href="" class="logo"><img class="img-circle" style="opacity: .8989;" src="../template/images/NavySeal.jpg" width="50" height="50"><b>NAVY<span>SEAL</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">

      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li title="Cerrar sesion" onclick="logoutt()" style="cursor: pointer;"><a class="logout"><i class="fa fa-sign-out"></i></a></li>
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
            <a class="active" href="../index.php">
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
              <li><a href="../administradores/index.php">Administradores</a></li>
              <li><a href="../operadores/index.php">Operadores</a></li>
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
              <a href="../clientes/index.php">
                <i class="fa fa-book"></i>
                <span>Clientes</span>
                </a>
            </li>
            <li class="sub-menu">
              <a href="../pedidos/index.php">
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
              <li><a href="../maquinas/index.php">Maquinas</a></li>
              <li><a href="../materiales/index.php">Materiales</a></li>
              <?php }?>
              <li><a href="../modelos/index.php">Modelos</a></li><?php }?>
              <?php if($_SESSION['privilegios'] != 3){?>
              <li><a href="../productos/index.php">Productos</a></li>
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