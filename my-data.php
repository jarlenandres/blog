<?php 
require_once 'includes/redirect.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>


<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Editar datos</h1>
    <br>
    <!-- Mostrar errores -->
    <?php if (isset($_SESSION['completado'])) : ?>
            <div class="alert alerta-exito">
                <?= $_SESSION['completado'] ?>
            </div>
        <?php elseif(isset($_SESSION['errors']['general'])): ?>
            <div class="alert alert-error">
                <?= $_SESSION['errors']['general'] ?>
            </div>
        <?php endif; ?>

        <form action="update-data.php" method="post">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?=$_SESSION['user']['nombre'] ?>">
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'name') : ''; ?>

            <label for="surname">Apellidos</label>
            <input type="text" name="surname" value="<?=$_SESSION['user']['apellidos'] ?>">
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'surname') : ''; ?>

            <label for="email">Correo</label>
            <input type="email" name="email" value="<?=$_SESSION['user']['email'] ?>">
            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>

            <input type="submit" name="submit" value="Actualizar">
        </form> 
    <?php deleteErrors(); ?>
</div> <!--fin principal -->
        
<?php require_once 'includes/footer.php' ?>
        