<?php
if(isset($_POST)){
    // Conexión con la base de datos
    require_once 'includes/conexion.php';

    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;

    // Array de errores
    $errors = array();

    // Validar los datos antes de guardarlos en la base de datos
    if(!empty($name)){
        $validate_name = true;
    }else{
        $validate_name = false;
        $errors['name'] = "El nombre no es valido";
    }

    // Comprobar que no lleguen errores
    if(count($errors) == 0){
        $sql = "INSERT INTO categorias VALUES(NULL, '$name');";
        $query = mysqli_query($db, $sql);
    }
}

header("Location: index.php");