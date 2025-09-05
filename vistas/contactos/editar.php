
<h2>Editar contacto</h2>
<form method="POST" action="/agenda_contactos_mvc/publico/contactos/actualizar">
  <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token'] ?? bin2hex(random_bytes(16))) ?>">
  <input type="hidden" name="id" value="<?= $contacto->id ?>">

  <div class="fila">
    <div style="flex:1 1 240px;">
      <label for="nombre">Nombre</label>
      <input id="nombre" name="nombre" value="<?= htmlspecialchars($contacto->nombre) ?>" required>
    </div>
    <div style="flex:1 1 240px;">
      <label for="telefono">Teléfono</label>
      <input id="telefono" name="telefono" value="<?= htmlspecialchars($contacto->telefono) ?>" required>
    </div>
  </div>

  <div class="fila">
    <div style="flex:1 1 240px;">
      <label for="correo">Correo electrónico</label>
      <input id="correo" name="correo" type="email" value="<?= htmlspecialchars($contacto->correo ?? '') ?>">
    </div>

  <button class="boton" type="submit">Actualizar</button>
  <a class="boton boton-secundario" href="/agenda_contactos_mvc/publico/contactos">Cancelar</a>
</form>
