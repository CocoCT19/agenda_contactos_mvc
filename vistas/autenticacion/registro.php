<h2>Registro</h2>
<form method="POST" action="/agenda_contactos_mvc/publico/registro">
  <input type="hidden" name="_token" value="<?= htmlspecialchars($this->generarTokenCsrf()) ?>">

  <div class="fila">
    <div style="flex:1 1 250px;">
      <label for="nombre">Nombre</label>
      <input id="nombre" name="nombre" required>
    </div>
    <div style="flex:1 1 250px;">
      <label for="correo">Correo electrónico</label>
      <input id="correo" name="correo" type="email" required>
    </div>
  </div>
  
  <div class="fila">
    <div style="flex:1 1 250px;">
      <label for="contrasena">Contraseña</label>
      <input id="contrasena" name="contrasena" type="password" required>
    </div>
    <div style="flex:1 1 250px;">
      <label for="confirmar_contrasena">Confirmar contraseña</label>
      <input id="confirmar_contrasena" name="confirmar_contrasena" type="password" required>
    </div>
  </div>
  
  <button class="boton" type="submit">Crear cuenta</button>
</form>
