<?php $edit = isset($docente); ?>
<h1 class="mb-3"><?= $edit ? 'Editar' : 'Nuevo' ?> docente</h1>
<form method="post" action="<?= BASE_URL ?>index.php?c=docentes&a=<?= $edit ? 'actualizar' : 'guardar' ?>">
  <input type="hidden" name="csrf" value="<?= Csrf::token() ?>" />
  <?php if ($edit): ?><input type="hidden" name="id_docente" value="<?= (int)$docente['id_docente'] ?>" /><?php endif; ?>
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">DNI</label>
      <input type="text" name="dni" class="form-control" required maxlength="15" value="<?= htmlspecialchars($docente['dni'] ?? '') ?>" />
    </div>
    <div class="col-md-4">
      <label class="form-label">Nombres</label>
      <input type="text" name="nombres" class="form-control" required value="<?= htmlspecialchars($docente['nombres'] ?? '') ?>" />
    </div>
    <div class="col-md-4">
      <label class="form-label">Apellidos</label>
      <input type="text" name="apellidos" class="form-control" required value="<?= htmlspecialchars($docente['apellidos'] ?? '') ?>" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Correo</label>
      <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($docente['correo'] ?? '') ?>" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Teléfono</label>
      <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($docente['telefono'] ?? '') ?>" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Especialidad</label>
      <input type="text" name="especialidad" class="form-control" value="<?= htmlspecialchars($docente['especialidad'] ?? '') ?>" />
    </div>
    <div class="col-md-3">
      <label class="form-label">Grado académico</label>
      <select name="grado_academico" class="form-select">
        <?php $grados = ['Bachiller','Licenciado','Magister','Doctor'];
        $sel = $docente['grado_academico'] ?? 'Licenciado';
        foreach ($grados as $g): ?>
          <option value="<?= $g ?>" <?= $sel===$g?'selected':'' ?>><?= $g ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Estado</label>
      <select name="estado" class="form-select">
        <?php $estados = ['Activo','Inactivo'];
        $selE = $docente['estado'] ?? 'Activo';
        foreach ($estados as $e): ?>
          <option value="<?= $e ?>" <?= $selE===$e?'selected':'' ?>><?= $e ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Guardar</button>
      <a class="btn btn-secondary" href="<?= BASE_URL ?>index.php?c=docentes&a=index">Cancelar</a>
    </div>
  </div>
</form>
