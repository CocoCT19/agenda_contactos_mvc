
<div class="fila" style="justify-content: space-between; align-items:center;">
  <h2>Hola <span = class="nombre-usuario"><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></span>, Estos son tus contactos!</h2>
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
      <td><a class="boton boton-secundario" href="/agenda_contactos_mvc/publico/contactos/editar?id=<?= $c->id ?>">Editar</a>
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

<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #6c63ff;
    color: #fff;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.boton {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    text-decoration: none;
    font-size: 13px;
    margin-right: 5px;
}

.boton-secundario {
    background-color: #4caf50;
}

.boton-peligro {
    background-color: #f44336;
}

.boton:hover {
    opacity: 0.9;
}



.nombre-usuario {
    font-weight: bold;
    font-size: 36px;

    background: linear-gradient(90deg, #6c63ff, #4caf50);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;


    background-clip: text;
    color: transparent;
}
</style>


