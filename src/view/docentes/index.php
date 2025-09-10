<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
  <h1 class="mb-0">Administrar docentes</h1>
  <div class="d-flex gap-2 w-100 w-md-auto">
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input id="adminSearch" type="text" class="form-control" placeholder="Filtrar por DNI, nombres, apellidos, especialidad">
    </div>
    <a class="btn btn-primary" href="<?= BASE_URL ?>index.php?c=docentes&a=crear"><i class="bi bi-plus-circle me-1"></i> Nuevo docente</a>
  </div>
</div>
<div class="table-responsive">
<table class="table table-hover align-middle" id="tablaDocentes">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>DNI</th>
      <th>Apellidos y Nombres</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Especialidad</th>
      <th>Grado</th>
      <th>Estado</th>
      <th class="text-end">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($docentes as $d): ?>
    <tr
      data-dni="<?= htmlspecialchars($d['dni']) ?>"
      data-nombres="<?= htmlspecialchars($d['nombres']) ?>"
      data-apellidos="<?= htmlspecialchars($d['apellidos']) ?>"
      data-especialidad="<?= htmlspecialchars($d['especialidad']) ?>">
      <td data-label="#"><?= (int)$d['id_docente'] ?></td>
      <td data-label="DNI"><?= htmlspecialchars($d['dni']) ?></td>
      <td data-label="Nombre"><i class="bi bi-person me-1"></i><?= htmlspecialchars($d['apellidos'] . ', ' . $d['nombres']) ?></td>
      <td data-label="Correo"><?= htmlspecialchars($d['correo']) ?></td>
      <td data-label="Tel."><?= htmlspecialchars($d['telefono']) ?></td>
      <td data-label="Esp."><?= htmlspecialchars($d['especialidad']) ?></td>
      <td data-label="Grado"><?= htmlspecialchars($d['grado_academico']) ?></td>
      <td data-label="Estado"><span class="badge bg-<?= ($d['estado']==='Activo'?'success':'secondary') ?>"><?= htmlspecialchars($d['estado']) ?></span></td>
      <td data-label="Acciones" class="text-end">
        <a class="btn btn-sm btn-outline-secondary" href="<?= BASE_URL ?>index.php?c=docentes&a=editar&id=<?= (int)$d['id_docente'] ?>"><i class="bi bi-pencil-square"></i> Editar</a>
        <form method="post" action="<?= BASE_URL ?>index.php?c=docentes&a=eliminar" class="d-inline" onsubmit="return confirm('¿Eliminar docente?');">
          <input type="hidden" name="csrf" value="<?= Csrf::token() ?>" />
          <input type="hidden" name="id_docente" value="<?= (int)$d['id_docente'] ?>" />
          <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Eliminar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<script>
setupFilter('adminSearch', '#tablaDocentes tbody tr', ['dni','nombres','apellidos','especialidad']);
</script>
