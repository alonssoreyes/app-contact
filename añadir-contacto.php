<?php
include_once('config/database.php');
$id_usuario = $_SESSION['usuario']['id'];
if(isset($_POST)){
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;

    if($nombre && $email && $telefono){
        $query = "INSERT INTO contacto VALUES (null,$id_usuario,'$nombre',$telefono,'$email')";

        $result = mysqli_query($conn,$query);

        if($result){
            echo "añadido";
        }else{
            echo "error";
        }
    }else{
        echo "vacios";
    }
}


?>