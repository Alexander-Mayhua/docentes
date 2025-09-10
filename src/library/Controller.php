<?php
abstract class Controller {
    protected function view(string $tpl, array $data = []): void {
        extract($data);
        $base = __DIR__ . '/../view/';
        $file = $base . $tpl . '.php';
        if (!file_exists($file)) { throw new Exception("Vista $tpl no encontrada"); }
        include $base . 'partials/header.php';
        include $file;
        include $base . 'partials/footer.php';
    }
    protected function redirect(string $path): void {
        header('Location: ' . BASE_URL . ltrim($path, '/'));
        exit;
    }
    protected function requireLogin(string $role = null): void {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash_warning'] = 'Debes iniciar sesión.';
            $this->redirect('index.php?c=auth&a=login');
        }
        if ($role && ($_SESSION['user']['rol'] ?? null) !== $role) {
            $_SESSION['flash_error'] = 'No tienes permisos para esa acción';
            $this->redirect('index.php');
        }
    }
}
