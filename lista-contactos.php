<?php

include_once('config/database.php');
$id = $_SESSION['usuario']['id'];
$query="SELECT u.id, c.* FROM usuario u INNER JOIN contacto c ON u.id=$id  WHERE c.usuario_id=$id";

$result = mysqli_query($conn,$query);
$jsonData = array();
while($contacto = mysqli_fetch_array($result)){
    $jsonData[] = array(
        'id' => $contacto['id'],
        'nombre' => $contacto['nombre_contacto'],
        'telefono' => $contacto['telefono'],
        'email' => $contacto['email']
    );
}

$jsonString = json_encode($jsonData);
echo $jsonString;

?>