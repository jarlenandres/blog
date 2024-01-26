<?php
// Iniciar la sesión y la conexión con la db
require_once 'includes/conexion.php';

// Recoger los datos del FORM
if(isset($_POST)){
    // Borrar sesión si el user se logea correctamente
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }
    
    $email = trim($_POST['email']);
    $pass = $_POST['pass'];

    // Consulta para comprobar las credenciales del user
    $sql = "SELECT * FROM users WHERE email = '$email'";

    // Query de consulta
    $login = mysqli_query($db, $sql);

    // Comprobar datos del user
    if($login && mysqli_num_rows($login) == 1){
        $user = mysqli_fetch_assoc($login);
        
        // Comprobar la contraseña
        $verify = password_verify($pass, $user['pass']);
        
        if($verify){
            // Utilizar una sesión para guardar los datos del usuario logueado
            $_SESSION['user'] = $user;
    
        }else{
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto";
        }
    }else{
        // Mensaje de error
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

// Redirigir al index.php
header("Location: index.php");

?>