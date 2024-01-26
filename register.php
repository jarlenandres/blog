<?php
if (isset($_POST)) {
    require_once 'includes/conexion.php';

    //Iniciar sesión
    if (!isset($_SESSION)) {
        session_start();
    }
    
    //Recoger los valores del FORM
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $surname = isset($_POST['surname']) ? mysqli_real_escape_string($db, $_POST['surname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $pass = isset($_POST['pass']) ? mysqli_real_escape_string($db, $_POST['pass']) : false;

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

    //validar campo de contraseña
    if (!empty($pass)) {
        $pass_validate = true;
    }else {
        $pass_validate = false;
        $errors['pass'] = "Error de registro de Contraseña";
    }

    $user_save = false;
    
    if (count($errors) == 0) {
        $user_save = true;

        //Cifrar la contraseña
        $secure_pass = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>4]);
        
        //Insertar datos a la tabla correspondiente
        $sql = "INSERT INTO users VALUES(null, '$name', '$surname', '$email', '$secure_pass', CURDATE());";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['completado'] = "Registro de usuario éxitoso";
        }else {
            $_SESSION['errors']['general'] = "Fallo en el registro de usuario";
        }

    }else {
        //Redirigir en caso de error
        $_SESSION['errors'] = $errors;
    }
}
header('Location: index.php');
?>