<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($titulo ?? 'Agenda de Contactos') ?></title>
</head>
<body>
  <header>
    <nav>
      <?php if (!empty($_SESSION['usuario'])): ?>
        <form action="/agenda_contactos_mvc/publico/cerrar-sesion" method="POST" style="display:inline">
          <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token'] ?? '') ?>">
          <button class="boton boton-secundario" type="submit">
            Salir 
          </button>
        </form>
      <?php else: ?>
     
      <?php endif; ?>
    </nav>
  </header>
  <main class="contenedor">
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alerta alerta-error">
        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['exito'])): ?>
      <div class="alerta alerta-exito">
        <?= htmlspecialchars($_SESSION['exito']); unset($_SESSION['exito']); ?>
      </div>
    <?php endif; ?>

    <?php include __DIR__ . '/' . $template . '.php'; ?>
  </main>
</body>
</html>
