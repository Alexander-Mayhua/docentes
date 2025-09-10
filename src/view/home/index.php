<div class="hero p-4 p-md-5 mb-4">
  <div class="row align-items-center g-3">
    <div class="col-lg-7">
      <h1 class="display-6 mb-2">Directorio de docentes</h1>
      <p class="mb-3">Busca por DNI, nombres, apellidos, especialidad o grado académico.</p>
      <div class="input-group input-group-lg">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input id="searchDocentes" type="text" class="form-control" placeholder="Buscar: DNI, nombre, especialidad…">
      </div>
    </div>
    <div class="col-lg-5 text-lg-end">
      <div class="d-flex gap-2 justify-content-lg-end">
        <span class="chip bg-light text-dark"><i class="bi bi-person-workspace me-1"></i>Especialidades</span>
        <span class="chip bg-light text-dark"><i class="bi bi-mortarboard me-1"></i>Grados</span>
        <span class="chip bg-light text-dark"><i class="bi bi-envelope me-1"></i>Contacto</span>
      </div>
    </div>
  </div>
</div>

<div class="row g-3" id="cardsDocentes">
  <?php foreach ($docentes as $d):
    $estadoCls = ($d['estado'] === 'Activo') ? 'success' : 'secondary';
    $telLink = !empty($d['telefono']) ? 'tel:' . preg_replace('/[^0-9+]/','', $d['telefono']) : '';
    $mailLink = !empty($d['correo']) ? 'mailto:' . htmlspecialchars($d['correo']) : '';
  ?>
    <div class="col-12 col-sm-6 col-lg-4"
         data-dni="<?= htmlspecialchars($d['dni']) ?>"
         data-nombres="<?= htmlspecialchars($d['nombres']) ?>"
         data-apellidos="<?= htmlspecialchars($d['apellidos']) ?>"
         data-especialidad="<?= htmlspecialchars($d['especialidad']) ?>"
         data-grado="<?= htmlspecialchars($d['grado_academico']) ?>">
      <div class="card h-100">
        <div class="card-body d-flex flex-column">
          <div class="d-flex align-items-start justify-content-between mb-1">
            <h5 class="card-title mb-0 pe-2">
              <?= htmlspecialchars($d['apellidos'] . ', ' . $d['nombres']) ?>
            </h5>
            <span class="badge badge-status bg-<?= $estadoCls ?>"><?= htmlspecialchars($d['estado']) ?></span>
          </div>
          <small class="text-muted d-block mb-2">
            <i class="bi bi-hash me-1"></i>DNI: <?= htmlspecialchars($d['dni']) ?>
          </small>
          <p class="card-text mb-2" style="min-height:3rem;">
            <i class="bi bi-bookmark-star me-1"></i><?= htmlspecialchars($d['especialidad']) ?>
            <br/>
            <i class="bi bi-mortarboard me-1"></i><?= htmlspecialchars($d['grado_academico']) ?>
          </p>
          <div class="mt-auto d-flex align-items-center justify-content-between">
            <div class="d-flex gap-2">
              <?php if ($mailLink): ?>
                <a class="btn btn-sm btn-outline-primary" href="<?= $mailLink ?>"><i class="bi bi-envelope"></i></a>
              <?php endif; ?>
              <?php if ($telLink): ?>
                <a class="btn btn-sm btn-outline-primary" href="<?= $telLink ?>"><i class="bi bi-telephone"></i></a>
              <?php endif; ?>
            </div>
            <span class="text-muted small"><?= htmlspecialchars($d['correo']) ?></span>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<script>
setupFilter('searchDocentes', '#cardsDocentes > div', ['dni','nombres','apellidos','especialidad','grado']);
</script>
