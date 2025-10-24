<h2>Usuarios</h2>
<a class="btn btn-sm btn-success" href="index.php?controller=admin&action=createUser">Nuevo usuario</a>
<table class="table mt-3">
  <thead><tr><th>Nombre</th><th>Usuario</th><th>Rol</th><th>Creado</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach ($users as $u): ?>
    <tr>
      <td><?=htmlspecialchars($u['nombre'])?></td>
      <td><?=htmlspecialchars($u['usuario'])?></td>
      <td><?=htmlspecialchars($u['rol'])?></td>
      <td><?=htmlspecialchars($u['fecha_creacion'])?></td>
      <td>
        <a class="btn btn-sm btn-danger" href="index.php?controller=admin&action=deleteUser&id=<?= $u['id'] ?>" onclick="return confirm('Eliminar?')">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
