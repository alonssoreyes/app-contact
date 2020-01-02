<?php

$conn = mysqli_connect('localhost','root','','agenda');
session_start();

if(!$conn){
    die("There's a problem with db connection, check the db and try again.");
}

?>