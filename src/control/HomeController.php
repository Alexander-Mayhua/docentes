<?php
final class HomeController extends Controller {
    public function indexAction(): void {
        $docentes = Docente::todos();
        $this->view('home/index', compact('docentes'));
    }
}
