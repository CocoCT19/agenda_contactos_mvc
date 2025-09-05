
<div class="fila" style="justify-content: space-between; align-items:center;">
  <h2>Mis contactos</h2>
  <a class="boton" href="/agenda_contactos_mvc/publico/contactos/crear">+ Nuevo contacto</a>
</div>

<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Correo electrónico</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($contactos as $c): ?>
    <tr>
      <td><?= htmlspecialchars($c->nombre) ?></td>
      <td><?= htmlspecialchars($c->telefono) ?></td>
      <td><?= htmlspecialchars($c->correo ?? '') ?></td>
      <td><?= htmlspecialchars($c->direccion ?? '') ?></td>
      <td>
        <a class="boton boton-secundario" href="/agenda_contactos_mvc/publico/contactos/editar?id=<?= $c->id ?>">Editar</a>
        
        <form method="POST" action="/agenda_contactos_mvc/publico/contactos/eliminar" style="display:inline" onsubmit="return confirm('¿Eliminar contacto?')">
          <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_token'] ?? '') ?>">
          <input type="hidden" name="id" value="<?= $c->id ?>">
          <button class="boton boton-peligro" type="submit">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
