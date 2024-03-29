<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>
                
<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Últimas entradas</h1>
    <?php
        $entradas = getTickets($db, true);
        if(!empty($entradas)):
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
        endif;
    ?>

    <div id="ver-todas">
        <a href="entries.php">Ver todas las entradas</a>
    </div>
</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
