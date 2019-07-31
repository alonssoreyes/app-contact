<?php


include_once('config/database.php');

$id = $_SESSION['usuario']['id'];
if (isset($_POST)) {
    $buscar = $_POST['buscar'];

    if (!empty($buscar)) {
        $query = "SELECT * FROM contacto WHERE nombre_contacto LIKE '%$buscar%' AND usuario_id=$id";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query Error' . mysqli_erro($conn));
        }

        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'nombre' => $row['nombre_contacto'],
                'telefono' => $row['telefono'],
                'email' => $row['email']
            );
        }

        $jsonString = json_encode($json);

        echo $jsonString;
    }
}
