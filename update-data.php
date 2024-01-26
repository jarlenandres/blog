<?php
if (isset($_POST)) {
    require_once 'includes/conexion.php';

    //Recoger los valores del FORM
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $surname = isset($_POST['surname']) ? mysqli_real_escape_string($db, $_POST['surname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    //Array de errores
    $errors = array();

    //Validar los datos antes de guardarlos en DB
    //validar campo de nombre
    if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        $name_validate = true;
    }else {
        $name_validate = false;
        $errors['name'] = "Error de registro de Nombre";
    }

    //validar campo de apellidos
    if (!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)) {
        $surname_validate = true;
    }else {
        $surname_validate = false;
        $errors['surname'] = "Error de registro de Apellidos";
    }

    //validar campo de correo
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    }else {
        $email_validate = false;
        $errors['email'] = "Error de registro de Correo";
    }
    
    $user_save = false;
    if (count($errors) == 0) {
        $user = $_SESSION['user'];
        $user_save = true;

        // COMPROBAR SI EL USUARIO YA EXISTE
        $sql = "SELECT id, email FROM users WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if($isset_user['id'] == $user['id'] || empty($isset_user)){

            // Actualizar datos a la tabla correspondiente
            $user = $_SESSION['user'];
            $sql = "UPDATE users SET nombre = '$name', apellidos = '$surname', email = '$email' WHERE id = ". $user['id'];
            $query = mysqli_query($db, $sql);

            if ($query) {
                $_SESSION['user']['nombre'] = $name;
                $_SESSION['user']['apellidos'] = $surname;
                $_SESSION['user']['email'] = $email;

                $_SESSION['completado'] = "Datos actualizados correctamente";
            }else {
                $_SESSION['errors']['general'] = "Fallo la actualización de la información";
            }
        }else{
            $_SESSION['errors']['general'] = "El usuario ya existe";
        }

    }else {
        //Redirigir en caso de error
        $_SESSION['errors'] = $errors;
    }
}
header('Location: my-data.php');
?>