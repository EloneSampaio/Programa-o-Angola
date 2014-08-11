<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoriaController
 *
 * @author sam
 */
class TutoriasController extends Controller {

    //put your code here
    private $tutorias;

    public function __construct() {
        parent::__construct();
        $this->tutorias = $this->LoadModelo("tutorial");
    }

    public function index($pagina = FALSE) {
       $this->view->setCss(array("css"));
        if (!$this->filtraInt($pagina)) {
            $pagina = false;
        } else {
            $pagina = (int) $pagina;
        }


        $this->getBibliotecas('paginador');
        $paginador = new Paginador();

       $this->view->title = "Pagina Tutorias";
        $this->view->tutorial = $paginador->paginar($this->tutorias->listar_tutorial(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'tutorias/index');
        $this->view->renderizar('index');
    }

    

}
