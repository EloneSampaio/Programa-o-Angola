<?php

/*
 * @sam
 */

class UsuarioController extends Controller {

    //put your code here
    private $usuario;

    public function __construct() {
        parent::__construct();
        $this->usuario = $this->LoadModelo("registrar");
    }

    public function index($pagina = FALSE) {
        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }


        $this->getBibliotecas('paginador');
        $paginador = new Paginador();
        $this->view->title = "Pagina de Usuarios";
        $this->view->link = "registrar";
        $this->view->usuarios = $paginador->paginar($this->usuario->listar_usuario(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'usuario/index');
        $this->view->renderizar('index');
    }

}
