
<div>
  <h1>Bienvenido a la Agenda de Contactos</h1>
  <p>Inicia sesión o regístrate para comenzar.</p>

  <?php if (empty($_SESSION['usuario'])): ?>
    <a class="boton" href="/agenda_contactos_mvc/publico/iniciar-sesion">Ingresar</a>
    <a class="boton boton-secundario" href="/agenda_contactos_mvc/publico/registro">Registrarme</a>
  <?php else: ?>
    <a class="boton" href="/agenda_contactos_mvc/publico/contactos">Ir a mis contactos</a>
  <?php endif; ?>
</div>
