<?php require_once 'conexion.php' ?>
<?php require_once 'helpers.php' ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>

<body>
    <!--CABECERA -->
    <header id="header">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>
        </div>
        <!--MENÚ -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">INICIO</a>
                </li>
                <?php 
                    $categorias = getCategory($db);
                    if(!empty($categorias)):
                        while($category = mysqli_fetch_assoc($categorias)):
                ?>
                        <li>
                            <a href="category.php?id=<?=$category['id']?>"><?=$category['nombre']?></a>
                        </li>
                <?php
                        endwhile; 
                    endif;
                ?>
                
                <li>
                    <a href="index.php">Sobre mí</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>

    <!-- CONTENIDO -->
    <div id="container">
