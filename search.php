<?php
 //Validar si existe POST['busqueda']
if(!isset($_POST['busqueda'])){
    header("Location: index.php");
}

require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
?>
                
<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Busqueda: <?=$_POST['busqueda']?></h1>
    <?php
        $entradas = getTickets($db, null, null, $_POST['busqueda']);
        
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
