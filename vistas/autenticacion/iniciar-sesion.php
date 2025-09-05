<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (empty($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(16));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
       
        .fila { display: flex; gap: 20px; margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .boton { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Iniciar sesión</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div style="color:red; margin-bottom:15px;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="/agenda_contactos_mvc/publico/iniciar-sesion">
        <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token']) ?>">

        <div class="fila">
            <div style="flex:1 1 300px;">
                <label for="correo">Correo electrónico</label>
                <input id="correo" name="correo" type="email" required>
            </div>
            <div style="flex:1 1 300px;">
                <label for="contrasena">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" required>
            </div>
        </div>

        <button class="boton" type="submit">Entrar</button>
    </form>
</body>
</html>
