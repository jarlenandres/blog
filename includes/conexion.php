<?php
$server = 'localhost';
$username = 'root';
$pass = '';
$database = 'blog';

//Conectar con la DB
$db = mysqli_connect($server, $username, $pass, $database);

//Configurar la codificación de caracteres
mysqli_query($db, "SET NAMES utf8");

//Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}
?>