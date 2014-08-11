<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author sam
 */
class IndexController extends Controller {

    //put your code here
    private $categorias;
    private $tutorias;

    public function __construct() {
        parent::__construct();
        $this->categorias = $this->LoadModelo("categoria");
        $this->tutorias = $this->LoadModelo("tutorial");
    }

    public function index() {



        //print_r($this->acl->getPermisos()); exit;
        $this->view->title = "Pagina Index";
        $this->view->setCss(array("css"));
        $this->view->categoria = $this->categorias->listar_categoria();
        $this->view->tutorial = $this->tutorias->listar_tutorial();
        $this->view->footer = $this->getFooter('footer', 'index');
        $this->view->renderizar("index");
    }

}
