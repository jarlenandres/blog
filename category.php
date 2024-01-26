<?php
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

    $categoriaActual = category($db, $_GET['id']);
        if(!isset($categoriaActual['id'])){
            header("Location: index.php");
        }

require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
?>
                
<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Entradas de <?=$categoriaActual['nombre']?></h1>
    <?php
        $entradas = getTickets($db, null, $_GET['id']);
        if(!empty($entradas) && mysqli_num_rows($entradas) >=1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
        <article class="entrada">
            <a href="entry.php?id=<?=$entrada['id']?>">
                <h2><?= $entrada['titulo'] ?></h2>
                <span class="fecha"><?= $entrada['categoria']." | ".$entrada['fecha'] ?></span>
                <p>
                    <?= substr($entrada['descripcion'], 0, 200)."..." ?>
                </p>
            </a>
    </article>
    <?php
            endwhile;
        else:
    ?>
    <div class="alert-error">No hay entradas en esta categoría</div>
    <?php
        endif;
    ?>

</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
