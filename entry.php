<?php
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

    $entryaActual = getEntry($db, $_GET['id']);
    if(!isset($entryaActual['id'])){
        header("Location: index.php");
    }

    require_once 'includes/header.php'; 
    require_once 'includes/sidebar.php';
?>

<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1><?=$entryaActual['titulo']?></h1>
    <a href="category.php?id=<?=$entryaActual['categoria_id']?>">
        <h2><?=$entryaActual['categoria']?></h2>
    </a>
    <h4><?=$entryaActual['fecha']?> | <?=$entryaActual['usuario']?></h4>
    <p>
        <?=$entryaActual['descripcion']?>
    </p>

    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $entryaActual['usuario_id']) :?>
        
        <br>
        <a href="edit-entry.php?id=<?=$entryaActual['id']?>" class="button button-green">Editar</a>
        <a href="delete-entry.php?id=<?=$entryaActual['id']?>" class="button">Borrar</a>
    <?php endif; ?>
</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
