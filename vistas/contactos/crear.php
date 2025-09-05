<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Validación de correo en el POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'El correo no es válido';
        header("Location: /agenda_contactos_mvc/publico/contactos/crear");
        exit();
    }
}
?>

<h2>Nuevo contacto</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div style="color:red; margin-bottom:15px;">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST" action="/agenda_contactos_mvc/publico/contactos/guardar">
  <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token'] ?? bin2hex(random_bytes(16))) ?>">

  <div class="fila">
    <div style="flex:1 1 240px;">
      <label for="nombre">Nombre</label>
      <input id="nombre" name="nombre" required>
    </div>
    <div style="flex:1 1 240px;">
      <label for="telefono">Teléfono</label>
      <input id="telefono" name="telefono" required>
    </div>
  </div>

  <div class="fila">
    <div style="flex:1 1 240px;">
      <label for="correo">Correo electrónico</label>
      <input id="correo" name="correo" type="email">
    </div>
  </div>

  <button class="boton" type="submit">Guardar</button>
  <a class="boton boton-secundario" href="/agenda_contactos_mvc/publico/contactos">Cancelar</a>
</form>
