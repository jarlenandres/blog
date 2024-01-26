<?php 
require_once 'includes/redirect.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear categoria</h1>
    <p>
        Añade nuevas categorias al blog para que usuarios puedan usarlas al crear sus entradas.
    </p>
    <br>
    <form action="save-category.php" method="POST">
        <label for="name">Nombre de la categoria</label>
        <input type="text" name="name">

        <input type="submit" value="Guardar">
    </form>
</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
        