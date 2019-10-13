<?php
include_once('config/database.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda contactos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome.min.css">


    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d8b82db4a1.js"></script>
</head>

<body class="bg-light">
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div class="container" style="height:79vh;">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <a href="#" class="navbar-brand text-white"><?= $_SESSION['usuario']['nombre'] ?></a>
                <ul class="navbar-nav ml-auto">
                    <form class="form-inline my-2 my-lg-0">
                    <input type="text" class="form-control mr-sm-2" id="buscar" placeholder="Buscar">
                    </form>
                    <a href="logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </ul>
            </nav><!-- menu -->

            <div class="container p-4 h-100">
                <div class="row">
                    <div class="col-lg-5 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-contacto">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="telefono" placeholder="Telefono Casa/Oficina/Celular" min="0" maxlength="10" pattern="[0-9]+" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email " required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"><i class="far fa-save"></i> Guardar contacto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-8">
                        <h1><i class="far fa-address-book"></i> Mis contactos</h1>
                        <table class="table table-hover bg-light">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="contactos"></tbody>
                            <tfoot id="respuesta"></tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <footer class="row bg-primary">
                <div class="col-md-6 ">
                    <h6 class="text-white">Developed by Alonso Reyes 2019</h6>
                </div>
                <div class="col-md-6 text-right">
                    <nav class="navbar float-right">
                        <ul>
                            <a href="https://www.facebook.com/alonssoreyes97" target="_blank" class="link text-white h4 mr-3"><i class="fab fa-facebook"></i></a>
                            <a href="https://api.whatsapp.com/api/send?phone=3324969166" target="_blank" class="link text-white h4 mr-3"><i class="fab fa-whatsapp"></i></a>

                            <a href="https://github.com/alonssoreyes/scripts" target="_blank" class="link text-white h4"><i class="fab fa-git"></i></a>

                        </ul>
                    </nav>
                </div>
            </footer>
        </div>
    <?php else : ?>
        <h1 class="text-center" style="margin-top:20%;"><a href="index.html">Inicia sesion</a> para ver tus contactos</h1>
    <?php endif; ?>

    <!-- SCRIPTS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
