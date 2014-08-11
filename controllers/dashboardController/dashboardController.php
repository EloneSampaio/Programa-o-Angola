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
class DashboardController extends Controller {

    //put your code here
    private $dashboards;

    public function __construct() {
        parent::__construct();

        $this->dashboards = $this->LoadModelo("categoria");
    }

    public function index() {
        Session::nivelRestrito(array("admin"));
        $this->view->setJs(array("novo"));
        $this->view->t=$this->dashboards->listar_categoria();
        $this->view->title = "Pagina de Administracção";
        $this->view->renderizar('index');
    }

}
