<?php
include_once('config/database.php');

if(isset($_POST)){
    $id = $_POST['id'];
    $query = "DELETE FROM contacto WHERE id=$id";

    mysqli_query($conn,$query);

    
}