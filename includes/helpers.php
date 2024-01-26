<?php

//Función para mostrar algún error del FORM registro 
function showErrors($errors, $campo){
    $alert = '';
    if (isset($errors[$campo]) && !empty($campo)) {
        $alert = "<div class='alert alert-error'>".$errors[$campo]."</div>";
    }
    return $alert;
}

//Función para borrar los mensajes de error del FORM registro
function deleteErrors(){
    $delete = false;
    
    // Borrar errores de registro en sidebar    
    if (isset($_SESSION['errors'])) {
        $_SESSION['errors'] = null;
        $delete = true;
    }

    // Borrar errores de crear entradas
    if(isset($_SESSION['errors_entry'])){
        $_SESSION['errors_entry'] = null;
        $delete = true;
    }
    
    //
    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $delete = true;
    }
    return $delete;
}

// Función conseguir todas categorias
function getCategory($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($conexion, $sql);

    $result = array();
    if($categorias && mysqli_num_rows($categorias) >=1 ){
        $result = $categorias;
    }
    return $result;
}

// Función conseguir por categoria
function category($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query($conexion, $sql);

    $result = array();
    if($categorias && mysqli_num_rows($categorias) >=1 ){
        $result = mysqli_fetch_assoc($categorias);
    }
    return $result;
}

// Función conseguir una entrada
function getEntry($conexion, $id){
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ".
            "INNER JOIN users u ON e.usuario_id = u.id ".
            "WHERE e.id = $id";
    $query = mysqli_query($conexion, $sql);

    $result = array();
    if($query && mysqli_num_rows($query) >=1){
        $result = mysqli_fetch_assoc($query);
    }
    return $result;
}

// Función conseguir todas las entradas
function getTickets($conexion, $limit = null, $category = null, $search = null){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ";

    if(!empty($category)){
        $sql .= "WHERE e.categoria_id = $category ";
    }

    if(!empty($search)){
        $sql .= "WHERE e.titulo LIKE '%$search%' ";
    }

    $sql .= "ORDER BY e.id DESC ";
    
    if($limit){
        // $sql = sql. "LIMIT 4"
        $sql .="LIMIT 4";
    }

    $entradas = mysqli_query($conexion, $sql);

    $result = array();
    if($entradas && mysqli_num_rows($entradas) >=1){
        $result = $entradas;
    }
    return $result;
}

?>