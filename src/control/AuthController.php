<?php
final class AuthController extends Controller {
    public function loginAction(): void { $this->view('auth/login'); }

    public function doLoginAction(): void {
        if (!Csrf::check($_POST['csrf'] ?? '')) { die('CSRF'); }
        $usuario = trim($_POST['usuario'] ?? '');
        $pass    = $_POST['password'] ?? '';

        $u = Usuario::porUsuario($usuario);
        if (!$u || !Usuario::verificarPassword($pass, $u['clave'])) {
            $_SESSION['flash_error'] = 'Credenciales inválidas';
            $this->redirect('index.php?c=auth&a=login');
        }
        $_SESSION['user'] = [ 'id' => (int)$u['id_usuario'], 'usuario' => $u['usuario'], 'rol' => $u['rol'] ];
        $this->redirect('index.php');
    }

    public function logoutAction(): void { session_destroy(); $this->redirect('index.php'); }
}
