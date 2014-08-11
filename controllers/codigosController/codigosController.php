<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of programacaoController
 *
 * @author sam
 */
class CodigosController extends Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->title="Pagina de codigos";
        $this->view->renderizar("index");
    }

    //put your code here
}
