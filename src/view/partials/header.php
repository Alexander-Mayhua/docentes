<?php
$usuario = $_SESSION['user'] ?? null;
$appName = defined('APP_NAME') ? APP_NAME : 'Gestión de Docentes';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $appName ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <style>
    :root { --brand:#0d6efd; --brand-2:#6610f2; }
    body { padding-top: 72px; }
    .navbar-brand { font-weight: 800; letter-spacing: .3px; }
    .card { transition: transform .15s ease, box-shadow .15s ease; }
    .card:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(0,0,0,.08); }
    .hero { background: linear-gradient(135deg,var(--brand) 0%, var(--brand-2) 100%); color:#fff; border-radius: 18px; }
    .chip { border-radius: 999px; padding: .25rem .6rem; font-weight:600; }
    .badge-status { font-size: .8rem; }
    @media (max-width: 575.98px){
      .table thead { display:none; }
      .table tbody tr { display:block; margin-bottom: .75rem; border:1px solid #e9ecef; border-radius: 12px; padding:.5rem; }
      .table tbody tr td { display:flex; justify-content:space-between; border:0; padding:.35rem .5rem; }
      .table tbody tr td::before { content: attr(data-label); font-weight:600; color:#6c757d; margin-right:.75rem; }
      .table .text-end { justify-content:flex-end; }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>index.php">
      <i class="bi bi-mortarboard"></i> <?= $appName ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbars">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>index.php">Inicio</a></li>
        <?php if ($usuario && ($usuario['rol'] ?? null) === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>index.php?c=docentes&a=index"><i class="bi bi-gear"></i> Admin Docentes</a></li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if ($usuario): ?>
          <li class="nav-item"><span class="navbar-text me-3"><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($usuario['usuario']) ?></span></li>
          <li class="nav-item"><a class="btn btn-outline-light" href="<?= BASE_URL ?>index.php?c=auth&a=logout">Salir</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="btn btn-primary" href="<?= BASE_URL ?>index.php?c=auth&a=login"><i class="bi bi-box-arrow-in-right me-1"></i> Ingresar</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <?php foreach (['success','error','warning'] as $t): $key = 'flash_' . $t; if (!empty($_SESSION[$key])): ?>
    <div class="alert alert-<?= $t ?> mt-2" role="alert">
      <?= htmlspecialchars($_SESSION[$key]); unset($_SESSION[$key]); ?>
    </div>
  <?php endif; endforeach; ?>
