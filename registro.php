<?php
//Database connection
include_once('config/database.php');

//Validacion
if (isset($_POST)) {
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : false;
    $email = !empty($_POST['email']) ? $_POST['email'] : false;
    $password = !empty($_POST['password']) ? $_POST['password'] : false;

    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

    if ($nombre && $email && $password) {
        $query = "INSERT INTO usuario VALUES(null,'$nombre','$email','$hash')";

        $result = mysqli_query($conn, $query);

        if (!result) {
            die('Algo ha fallado');
        }
        echo "<script> alert('Registrado con exito'); </script>";
    }



    
}
