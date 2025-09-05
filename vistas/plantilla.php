<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($titulo ?? 'Agenda de Contactos') ?></title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin:0; background:#f6f7fb; }
    header, footer { background:#111827; color:#fff; padding:12px 16px; }
    nav a { color:#fff; margin-right:12px; text-decoration:none; }
    .contenedor { max-width:1000px; margin:20px auto; background:#fff; padding:18px; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,.06); }
    .boton { padding:8px 12px; border-radius:8px; border:1px solid #e5e7eb; background:#111827; color:#fff; text-decoration:none; cursor:pointer; }
    .boton-secundario { background:#fff; color:#111827; }
    .boton-peligro { background:#b91c1c; color:#fff; }
    .fila { display:flex; gap:10px; flex-wrap:wrap; }
    input, textarea { width:100%; padding:10px; border:1px solid #e5e7eb; border-radius:8px; }
    table { width:100%; border-collapse: collapse; }
    th, td { padding:10px; border-bottom:1px solid #e5e7eb; text-align:left; }
    .alerta { padding:10px; border-radius:8px; margin-bottom:12px; }
    .alerta-error { background:#fee2e2; color:#991b1b; }
    .alerta-exito { background:#dcfce7; color:#166534; }
  </style>
</head>
<body>
  <header>
    <nav>
      <?php if (!empty($_SESSION['usuario'])): ?>
        <form action="/agenda_contactos_mvc/publico/cerrar-sesion" method="POST" style="display:inline">
          <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token'] ?? '') ?>">
          <button class="boton boton-secundario" type="submit">
            Salir (<?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>)
          </button>
        </form>
      <?php else: ?>
        <a href="/agenda_contactos_mvc/publico/iniciar-sesion">Ingresar</a>
        <a href="/agenda_contactos_mvc/publico/registro">Registro</a>
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
