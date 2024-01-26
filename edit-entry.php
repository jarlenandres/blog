<?php
require_once 'includes/redirect.php';
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
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada <?=$entryaActual['titulo'] ?>
    </p>
    <br>
    <!-- Mostrar errores -->
    <?php if(isset($_SESSION['completado'])) : ?>
        <div class="alert alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif(isset($_SESSION['errors']['general'])): ?>
        <div>
            <?= $_SESSION(['errors']['general']) ?>
        </div>
    <?php endif; ?>

    <form action="save-entry.php?edit=<?=$entryaActual['id']?>" method="POST">
        <label for="title">Titulo</label>
        <input type="text" name="title" value="<?=$entryaActual['titulo'] ?>">
        <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'title') : ''; ?>

        <label for="description">Descripción</label>
        <textarea name="description"><?=$entryaActual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'description') : ''; ?>

        <label for="category">Categoría</label>
        <select name="category" id="category">
            <?php
                $categorias = getCategory($db);
                if(!empty($categorias)):
                    while ($category = mysqli_fetch_assoc($categorias)):
            ?>
            <option value="<?=$category['id']?>" <?=($category['id'] == $entryaActual['categoria_id']) ? 'selected="selected"' : '' ?>>
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
        