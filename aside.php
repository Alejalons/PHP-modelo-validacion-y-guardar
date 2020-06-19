<?php require_once 'helper.php'; ?>

            <aside id="sidebar">
                <div id="login" class="bloque">
                    <h3>Identificate</h3>
                    <form action="login.php" method="POST">
                        <label for="email">Email</label>
                        <input type="email" name="email">

                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Entrar">
                    </form>
                </div>

                <div id="register" class="bloque">
                    <h3>Registrate</h3>
                    <?php if(isset($_SESSION['guardado'])): ?>
                        <div class='alerta'>
                        <?=$_SESSION['guardado'];?>
                        </div>
                    <?php elseif(isset($_SESSION['errores']['general'])):?>
                        <div class='alerta alerta-error'>
                            <?=$_SESSION['errores']['general'];?>
                        </div>
                    <?php endif;?>
                    
                    <form action="registro.php" method="POST">
                        <label for="nombre">Nombre</label>
                        <?php echo  isset($_SESSION['errores'])? mostrarError($_SESSION['errores'], 'nombre'): '' ?>
                        <input type="text" name="nombre">

                        <label for="apellido">Apellido</label>
                        <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : '' ?>
                        <input type="text" name="apellido">

                        <label for="email">Email</label>
                        <?php echo isset($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'email')  : ''?>
                        <input type="email" name="email">

                        <label for="password">Contraseña</label>
                        <?php echo isset($_SESSION['errores']) ?  mostrarError($_SESSION['errores'], 'password') : '' ?>
                        <input type="password" name="password">

                        <input type="submit" name="submit" value="Registrar">
                    </form>
                    <?php borrarErrores(); ?>
                </div>
            </aside>
