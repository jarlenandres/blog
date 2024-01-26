<?php 
require_once 'includes/redirect.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear entrada</h1>
    <br>
    <form action="save-entry.php" method="POST">
        <label for="title">Titulo</label>
        <input type="text" name="title">
        <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'title') : ''; ?>

        <label for="description">Descripción</label>
        <textarea name="description"></textarea>
        <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'description') : ''; ?>

        <label for="category">Categoría</label>
        <select name="category" id="category">
            <?php
                $categorias = getCategory($db);
                if(!empty($categorias)):
                    while ($category = mysqli_fetch_assoc($categorias)):
            ?>
            <option value="<?=$category['id']?>">
                <?=$category['nombre']?>            
            </option>
            <?php
                    endwhile;
                endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'category') : ''; ?>

        <input type="submit" value="Guardar">
    </form>
    <?php deleteErrors(); ?>
</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
        