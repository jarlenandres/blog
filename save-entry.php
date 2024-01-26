<?php
if(isset($_POST)){
    // Conexión con la base de datos
    require_once 'includes/conexion.php';

    $title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
    $category = isset($_POST['category']) ? (int) $_POST['category'] : false;
    $user = $_SESSION['user']['id'];

    //Array de errores
    $errors = array();

    // Validar los datos antes de guardarlos en la base de datos
    // Validar titulo
    if(empty($title)){
        $errors['title'] = "Error al registrar el titulo";
    }

    // Validar la descripción
    if(empty($description)){
        $errors['description'] = "Error con el campo de la descripción";
    }

    // Validar la categoria
    if(empty($category) && !is_numeric($category)){
        $errors['category'] = "Error con el registro de la categoria";
    }

    // Comprobar que no lleguen errores
    if(count($errors) == 0){
        if(isset($_GET['edit'])){
            $entry_id = $_GET['edit'];
            $user_id = $_SESSION['user']['id'];

            $sql = "UPDATE entradas SET titulo='$title', descripcion='$description', catego<?ria_id=$category".
            " WHERE id = $entry_id AND usuario_id = $user_id";
        }else{
            $sql = "INSERT INTO entradas VALUES(NULL, $user, $category, '$title', '$description', CURDATE());";

        }
        $query = mysqli_query($db, $sql);
        
        header("Location: index.php");
    }else{
        $_SESSION['errors_entry'] = $errors;
        if(isset($_GET['edit'])){
            header("Location: edit-entry.php?id=".$_GET['edit']);
        }else{
            header("Location: create-entries.php");
        }
    }
}
