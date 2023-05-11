<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="template/images/NavySeal.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template/style.css">
    <link rel="stylesheet" href="template/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/bootstrap.min.js"></script>
    <script src="template/js/jquery.min.js"></script>
    <script src="template/js/scripts.js"></script>
    <script src="template/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>
<body>
    <div class="col-md-12" style="background: black; padding: 2%;"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="padding-top: 12%; padding-bottom: 25%;"></div>
                <div class="col-md-8" style="background-color: white; padding-top: 12%; padding-bottom: 25%">
                <div class="col-md-12" style="text-align: center;"> 
                <img src="template/images/NavySeal.jpg" alt="Navy Seal" width="200" height="150" style="max-width: 200px; min-width: 100px; max-height: 150px; min-height: 100px;">
                </div>
                    <form method="POST">
                        <div class="form-group col-md-12">
                            <label for="">NicK</label>
                            <input name="nick" type="text" id="nick" class="form-control" placeholder="Escriba su Nick de usuario" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Password</label>
                            <input name="pass" type="password" id="pass" class="form-control" placeholder="*******" required>
                        </div>
                        <div  class="col-md-12" style="text-align: right;">
                            <button type="button" class="btn btn-success form-control" onclick="logIn()">Entrar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2" style="padding-top: 12%; padding-bottom: 25%;"></div>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small unique-color-dark">
        <div class="footer-copyright text-center py-3" style="background: black; color: white">© 2021: Navy Seal S. de R.L. de C.V
        </div>
    </footer>
</body>
</html>