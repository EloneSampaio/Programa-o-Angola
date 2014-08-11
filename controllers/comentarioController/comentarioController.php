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
class ComentarioController extends Controller {

    //put your code here
    private $comentarios;

    public function __construct() {
        parent::__construct();
        $this->comentarios = $this->LoadModelo("comentario");
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

        $this->view->link = "comentario/novo";
        $this->view->title = "Pagina Comentario";
        $this->view->comentario = $paginador->paginar($this->comentarios->listar_comentario(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'comentario/index');
        $this->view->renderizar('index');
    }

    public function novo() {

        
        $this->view->setJs(array("novo"));
        if ($this->getInt("guardar") == 1) {
            $this->view->dados = $_POST;
            if (!$this->getTexto('nome')) {
                $this->view->erro = "O Campo Nome é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getTexto('comentario')) {
                $this->view->erro = "O Campo Nome é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            $data = array();
            $data['nome'] = $this->getTexto('nome');
            $data['comentario'] = $this->getTexto('comentario');

            if ($cat = $this->comentarios->verificar_comentario($data['nome'])) {
                $this->view->mensagem = "Já existe uma categoria com esse nome " . $cat['nome'] . "";
                $this->view->renderizar("novo");
                exit;
            }


            $this->comentarios->novo_comentario($data);
            if (!$this->comentarios->verificar_comentario($data['nome'])) {
                $this->view->erro = "Não Possivel criar o comentario";
                $this->view->renderizar("novo");
                exit;
            }
            
            $this->redirecionar("comentario");
            $this->view->mensagem = "O seu comentario foi criado com Sucesso";
        }

        $this->view->renderizar("novo");
    }

    public function editar($id) {
      
        if (!$this->filtraInt($id)) {
            $this->redirecionar("comentario");
        }
        if (!$this->comentarios->listar_id($this->filtraInt($id))) {
            $this->redirecionar("comentario");
        }

        $this->view->titulo = "Editar Comentario";
        $this->view->setJs(array("novo"));
        if ($this->getInt("guardar") == 1) {
            $this->view->dados = $_POST;
            if (!$this->getTexto('nome')) {
                $this->view->erro = "O Campo Nome é Obrigatorio preencha-o";
                $this->view->renderizar("editar");
                exit;
            }
            if (!$this->getTexto('comentario')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("editar");
                exit;
            }
            $data = array();
            $data['id'] = $this->filtraInt($id);

            $data['nome'] = $this->getTexto('nome');
            $data['comentario'] = $this->getTexto('comentario');

            $this->comentarios->editar_comentario($data);


            $this->redirecionar("comentario");
        }

        $this->view->dados = $this->comentarios->listar_id($this->filtraInt($id));
        $this->view->renderizar("editar");
    }

    public function apagar($id) {
        Session::nivelRestrito(array("usuario"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("comentario");
        }

        if (!$this->comentarios->listar_id($this->filtraInt($id))) {
            $this->redirecionar("comentario");
        }
        $this->comentarios->apagar_comentario($this->filtraInt($id));
        $this->redirecionar("comentario");
    }

}
