<?php
include_once('config/database.php');


if(isset($_POST)){
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    $query = "SELECT * FROM usuario WHERE email='$email'";
    $result = mysqli_query($conn,$query);

    if($result && mysqli_num_rows($result)==1){
        $usuario = mysqli_fetch_array($result);

        $verify = password_verify($password,$usuario['password']);
        $jsonData= array();
        if($verify){
            while($us = mysqli_fetch_array($result)){
                $jsonData[] = array(
                    'id'=> $us['id'],
                    'nombre'=> $us['nombre'],
                    'email' => $us['email'],
                    'password' => $us['password']
                );
            }
            $jsonString = json_encode($jsonData);
            echo $jsonString;
            $_SESSION['usuario'] = $usuario;
            
        }else{
            echo "<p class='text-danger'>Contraseña incorrecta</p>";
        }
    }else{
        echo "<p class='text-danger'>El email no existe</p>";
    }
}


?>