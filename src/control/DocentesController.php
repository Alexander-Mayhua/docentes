<?php
final class DocentesController extends Controller {
    public function indexAction(): void {
        $this->requireLogin('admin');
        $docentes = Docente::todos();
        $this->view('docentes/index', compact('docentes'));
    }

    public function crearAction(): void {
        $this->requireLogin('admin');
        $this->view('docentes/form');
    }

    public function guardarAction(): void {
        $this->requireLogin('admin');
        if (!Csrf::check($_POST['csrf'] ?? '')) { die('CSRF'); }
        $data = self::filtrar($_POST);
        try {
            Docente::crear($data);
            $_SESSION['flash_success'] = 'Docente creado';
        } catch (Throwable $e) {
            $_SESSION['flash_error'] = 'Error al crear: ' . $e->getMessage();
        }
        $this->redirect('index.php?c=docentes&a=index');
    }

    public function editarAction(): void {
        $this->requireLogin('admin');
        $id = (int)($_GET['id'] ?? 0);
        $docente = Docente::uno($id);
        if (!$docente) { die('Docente no encontrado'); }
        $this->view('docentes/form', compact('docente'));
    }

    public function actualizarAction(): void {
        $this->requireLogin('admin');
        if (!Csrf::check($_POST['csrf'] ?? '')) { die('CSRF'); }
        $id = (int)($_POST['id_docente'] ?? 0);
        $data = self::filtrar($_POST);
        try {
            Docente::actualizar($id, $data);
            $_SESSION['flash_success'] = 'Docente actualizado';
        } catch (Throwable $e) {
            $_SESSION['flash_error'] = 'Error al actualizar: ' . $e->getMessage();
        }
        $this->redirect('index.php?c=docentes&a=index');
    }

    public function eliminarAction(): void {
        $this->requireLogin('admin');
        if (!Csrf::check($_POST['csrf'] ?? '')) { die('CSRF'); }
        $id = (int)($_POST['id_docente'] ?? 0);
        try {
            Docente::eliminar($id);
            $_SESSION['flash_success'] = 'Docente eliminado';
        } catch (Throwable $e) {
            $_SESSION['flash_error'] = 'Error al eliminar: ' . $e->getMessage();
        }
        $this->redirect('index.php?c=docentes&a=index');
    }

    private static function filtrar(array $src): array {
        return [
            'dni'             => trim($src['dni'] ?? ''),
            'nombres'         => trim($src['nombres'] ?? ''),
            'apellidos'       => trim($src['apellidos'] ?? ''),
            'correo'          => trim($src['correo'] ?? ''),
            'telefono'        => trim($src['telefono'] ?? ''),
            'especialidad'    => trim($src['especialidad'] ?? ''),
            'grado_academico' => trim($src['grado_academico'] ?? 'Licenciado'),
            'estado'          => trim($src['estado'] ?? 'Activo'),
        ];
    }
}
