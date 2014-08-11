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
class TutorialController extends Controller {

    //put your code here
    private $tutorias;

    public function __construct() {
        parent::__construct();
        $this->tutorias = $this->LoadModelo("tutorial");
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

        $this->view->link = "tutorial/novo";
        $this->view->title = "Pagina Tutorial";
        $this->view->tutorial = $paginador->paginar($this->tutorias->listar_tutorial(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'tutorial/index');
        $this->view->renderizar('index');
    }

    public function novo() {

        $listar_categoria = $this->LoadModelo('categoria');
        $this->view->listar_categoria = $listar_categoria->listar_categoria();

        Session::nivelRestrito(array("admin"));
        $this->view->setJs(array("tinymce/tinymce.min"));
        if ($this->getInt("guardar") == 1) {
            $this->view->dados = $_POST;

            if (!$this->getTexto('titulo')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getTexto('descricao')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('destaque')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('msg')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('status')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }

            try {
                $caminhotemp = $_SERVER['DOCUMENT_ROOT'] . DS . "public" . DS . "img" . DS . "tutorial" . DS . "temp" . DS;
                $caminho = $_SERVER['DOCUMENT_ROOT'] . DS . "public" . DS . "img" . DS . "tutorial" . DS . "img" . DS;
                $imagem = "";




                $tempFile = $_FILES['file']['tmp_name'];
                //na linha abaixo você coloca a pasta, relativa ao root... (no meu caso /site/fotos/ )

                $targetFile = $caminhotemp . $_FILES['file']['name'];

                move_uploaded_file($tempFile, $targetFile);

                $this->getBibliotecas("upload" . DS . "class.upload");
                //UPLOAD DA IMAGEM	
                $handle = new Upload($targetFile);
                // Então verificamos se o arquivo foi carregado corretamente

                if ($handle->uploaded) {
                    // Definimos as configurações desejadas da imagem maior
                    $handle->image_resize = true;
                    $handle->image_y = 650;
                    $handle->image_ratio_x = true;
                    $handle->jpeg_quality = 100;
                    $i = md5(uniqid(""));
                    $handle->file_new_name_body = 'foto' . "_" . $i;
                    $handle->mime_check = true;
                    $handle->Process($caminho . DS);
                    // Em caso de sucesso no upload podemos fazer outras ações como insert em um banco de cados
                    if ($handle->processed) {
                        $imagem = $handle->file_dst_name;
                    }
                } else {
                    $this->view->erro = "O Campo Imagem é   Obrigatorio preencha-o";
                    $this->view->renderizar("novo");
                    exit;
                }

                $data = array();
                $data['categoria'] = $this->alphaNumeric('categoria');
                $data['descricao'] = $this->alphaNumeric('descricao');
                $data['titulo'] = $this->alphaNumeric('titulo');
                $data['destaque'] = $this->alphaNumeric('destaque');
                $data['msg'] = $this->alphaNumeric('msg');
                $data['status'] = $this->alphaNumeric('status');

                if ($cat = $this->tutorias->verificar_tutorial($data['titulo'])) {
                    $this->view->mensagem = "Já existe uma categoria com esse nome " . $cat['titulo'] . "";
                    $this->view->renderizar("novo");
                    exit;
                }


                $this->tutorias->novo_tutorial($data, $imagem);
                if (!$this->tutorias->verificar_tutorial($data['titulo'])) {
                    $this->view->erro = "Não Possivel criar a categoria";
                    $this->view->renderizar("novo");
                    exit;
                }
                unlink($caminhotemp . $_FILES['file']['name']);
            } catch (Exception $ex) {
                print $ex->getMessage();
            }
            $this->view->mensagem = "A sua conta foi criada com Sucesso";
        }

        $this->view->renderizar("novo");
    }

    public function editar($id) {
        Session::nivelRestrito(array("admin"));
        $this->view->setJs(array("tinymce/tinymce.min"));
        $listar_categoria = $this->LoadModelo('categoria');
        $this->view->dados = $this->tutorias->listar_id($this->filtraInt($id));
        $this->view->listar_categoria = $listar_categoria->listar_categoria();

        if (!$this->filtraInt($id)) {
            $this->redirecionar("tutorial");
        }
        if (!$this->tutorias->listar_id($this->filtraInt($id))) {
            $this->redirecionar("tutorial");
        }

        $this->view->titulo = "Editar tutorial";
        $this->view->setJs(array("novo"));

        if ($this->getInt("guardar") == 1) {
            if (!$this->getTexto('titulo')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }

            if (!$this->getTexto('descricao')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('destaque')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('msg')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('status')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }

            try {


                $data = array();
                $data['id'] = $this->filtraInt($id);
                $data['categoria'] = $this->alphaNumeric('categoria');
                $data['descricao'] = $this->alphaNumeric('descricao');
                $data['titulo'] = $this->alphaNumeric('titulo');
                $data['destaque'] = $this->alphaNumeric('destaque');
                $data['msg'] = $this->alphaNumeric('msg');
                $data['status'] = $this->alphaNumeric('status');


                $this->tutorias->editar_tutorial($data);

                $this->redirecionar("tutorial");
            } catch (Exception $ex) {
                print $ex->getMessage();
            }
            $this->view->mensagem = "A sua conta foi alterada com Sucesso";
        }




        $this->view->renderizar("editar");
    }

    public function apagar($id) {
        Session::nivelRestrito(array("admin"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("tutorial");
        }

        if (!$this->tutorias->listar_id($this->filtraInt($id))) {
            $this->redirecionar("tutorial");
        }
        $this->tutorias->apagar_tutorial($this->filtraInt($id));
        $this->redirecionar("tutorial");
    }

}
