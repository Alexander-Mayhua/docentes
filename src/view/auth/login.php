<div class="row justify-content-center mt-4">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Iniciar sesión</h5>
        <form method="post" action="<?= BASE_URL ?>index.php?c=auth&a=doLogin">
          <input type="hidden" name="csrf" value="<?= Csrf::token() ?>" />
          <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required />
          </div>
          <button class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
