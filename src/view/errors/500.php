<div class="container py-5">
  <h1 class="display-6">Error</h1>
  <p class="text-muted"><?= htmlspecialchars($message ?? 'Error inesperado'); ?></p>
  <a href="<?= BASE_URL ?>index.php" class="btn btn-primary">Volver al inicio</a>
</div>
