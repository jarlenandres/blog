<!--BARRA LATERAL -->
<aside id="sidebar">

    <!--Buscador -->
    <div id="buscador" class="block-aside">
        <h3>Buscar</h3>

        <form action="search.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if(isset($_SESSION['user'])): ?>
        <div  id="user-login" class="block-aside">
        <h3>Bienvenido <?= $_SESSION['user']['nombre']. ' '.$_SESSION['user']['apellidos']; ?></h3>
        <a href="create-entries.php" class="button button-green">Crear entradas</a>
        <a href="create-category.php" class="button">Crear categoria</a>
        <a href="my-data.php" class="button button-orange">Mis datos</a>
        <a href="close.php" class="button button-red">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['user'])): ?>
        <div id="login" class="block-aside">
            <h3>Ingresar</h3>

            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alert alert-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <label for="email">Correo</label>
                <input type="email" name="email">

                <label for="pass">Contraseña</label>
                <input type="password" name="pass">

                <input type="submit" value="Entrar">
            </form>
        </div>

        <div id="register" class="block-aside">
            <h3>Registrarse</h3>

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

            <!-- Registro de usuario -->
            <form action="register.php" method="post">
                <label for="name">Nombre</label>
                <input type="text" name="name">
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'name') : ''; ?>

                <label for="surname">Apellidos</label>
                <input type="text" name="surname">
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'surname') : ''; ?>

                <label for="email">Correo</label>
                <input type="email" name="email">
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>

                <label for="pass">Contraseña</label>
                <input type="password" name="pass">
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'pass') : ''; ?>

                <input type="submit" name="submit" value="Registrar">
            </form> 
            <?php deleteErrors(); ?>
        </div>
    <?php endif; ?>
</aside>
