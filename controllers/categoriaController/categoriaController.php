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
class CategoriaController extends Controller {

    //put your code here
    private $categorias;

    public function __construct() {
        parent::__construct();
        $this->categorias = $this->LoadModelo("categoria");
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

        $this->view->link = "categoria/novo";
        $this->view->title = "Pagina Categoria";
        $this->view->categoria = $paginador->paginar($this->categorias->listar_categoria(), $pagina);
        $this->view->paginacion = $paginador->getView('paginacao', 'categoria/index');

        $this->view->renderizar('index');
    }

    public function novo() {

        Session::nivelRestrito(array("admin"));
        $this->view->setJs(array("novo"));
        if ($this->getInt("guardar") == 1) {
            $this->view->dados = $_POST;
            if (!$this->getTexto('nome')) {
                $this->view->erro = "O Campo Nome é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            if (!$this->getTexto('descricao')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("novo");
                exit;
            }
            try {
                $caminhotemp = $_SERVER['DOCUMENT_ROOT'] . DS . "public" . DS . "img" . DS . "categoria" . DS . "temp" . DS;
                $caminho = $_SERVER['DOCUMENT_ROOT'] . DS . "public" . DS . "img" . DS . "categoria" . DS . "img" . DS;
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
                $data['nome'] = $this->getTexto('nome');
                $data['descricao'] = $this->getTexto('descricao');

                if ($cat = $this->categorias->verificar_categoria($data['nome'])) {
                    $this->view->mensagem = "Já existe uma categoria com esse nome " . $cat['nome'] . "";
                    $this->view->renderizar("novo");
                    exit;
                }


                $this->categorias->nova_categoria($data, $imagem);
                if (!$this->categorias->verificar_categoria($data['nome'])) {
                    $this->view->erro = "Não Possivel criar a categoria";
                    $this->view->renderizar("novo");
                    exit;
                }
                unlink($caminhotemp . $_FILES['file']['name']);
                $this->redirecionar("categoria");
                $this->view->mensagem = "A sua conta foi criada com Sucesso";
            } catch (Exception $ex) {
                print $ex->getMessage();
            }
        }

        $this->view->renderizar("novo");
    }

    public function editar($id) {
        Session::nivelRestrito(array("usuario"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("categoria");
        }
        if (!$this->categorias->listar_id($this->filtraInt($id))) {
            $this->redirecionar("categoria");
        }

        $this->view->titulo = "Editar Categoria";
        $this->view->setJs(array("novo"));
        if ($this->getInt("guardar") == 1) {
            $this->view->dados = $_POST;
            if (!$this->getTexto('nome')) {
                $this->view->erro = "O Campo Nome é Obrigatorio preencha-o";
                $this->view->renderizar("editar");
                exit;
            }
            if (!$this->getTexto('descricao')) {
                $this->view->erro = "O Campo Descrição é Obrigatorio preencha-o";
                $this->view->renderizar("editar");
                exit;
            }
            $data = array();
            $data['id'] = $this->filtraInt($id);

            $data['nome'] = $this->getTexto('nome');
            $data['descricao'] = $this->getTexto('descricao');

            $this->categorias->editar_categoria($data);


            $this->redirecionar("categoria");
        }

        $this->view->dados = $this->categorias->listar_id($this->filtraInt($id));
        $this->view->renderizar("editar");
    }

    public function apagar($id) {
        Session::nivelRestrito(array("usuario"));
        if (!$this->filtraInt($id)) {
            $this->redirecionar("categoria");
        }

        if (!$this->categorias->listar_id($this->filtraInt($id))) {
            $this->redirecionar("categoria");
        }
        $this->categorias->apagar_categoria($this->filtraInt($id));
        $this->redirecionar("categoria");
    }

}
