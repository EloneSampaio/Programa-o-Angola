<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once URL."libs".DS."libs".DS."Smarty".DS."libs".DS."Smarty.class.php.php";
/**
 * Description of View
 *
 * @author sam
 */
class View {

    private $_controller;
    private $_js;
    private $_css;

    //put your code here
    function __construct(Request $pedido) {
        //parent::__construct();
        $this->_controller = $pedido->getController();
        $this->_js = array();
        $this->_css = array();
    }

    public function renderizar($nome, $item = FALSE) {


        // $this->template_dir=ROOT."views".DS."layout".DS.DEFAULT_LAYOUT.DS;
        //$this->config_dir=ROOT."".DS."layout".DS.DEFAULT_LAYOUT.DS."configs";
        //$this->cache_dir=ROOT."tmp".DS."cache".DS;
        //$this->compile_dir=ROOT."tmp".DS."templates".DS;

        $menu = array(
          
            array(
                "id" => "Tutorias",
                "titulo" => "tutorias",
                "link" => URL . "tutorias"
            )
        );
        if (Session::get('autenticado')) {
            $menu[] = array(
                "id" => "login",
                "titulo" => "Encerrar ",
                "link" => URL . "login/logof"
            );

            $menu[] = array(
                "id" => "dashboard",
                "titulo" => "Dashboard",
                "link" => URL . "dashboard"
            );
        } else {
            $menu[] = array(
                "id" => "login",
                "titulo" => "Inciar Sessão",
                "link" => URL . "login"
            );

            $menu[] = array(
                "id" => "registrar",
                "titulo" => "Registrar-se",
                "link" => URL . "registrar"
            );
        }


        $admin = array(
            array(
                "id" => "categoria",
                "titulo" => "categoria",
                "link" => URL . "categoria"
            ),
            array(
                "id" => "tutorial",
                "titulo" => "tutorial",
                "link" => URL . "tutorial"
            ),
            
            array(
                "id" => "codigos",
                "titulo" => "codigos",
                "link" => URL . "codigos"
            ),
            array(
                "id" => "comentario",
                "titulo" => "comentario",
                "link" => URL . "comentario"
            ),
              array(
                "id" => "usuario",
                "titulo" => "usuario",
                "link" => URL . "usuario"
            )
            
        );

        $js = array();
        if (count($this->_js)) {
            $js = $this->_js;
        }
        $css = array();
        if (count($this->_css)) {
            $css = $this->_css;
        }


        $_layoutParam = array(
            "caminho_css" => URL . "views/layout" . DS . DEFAULT_LAYOUT . "/css/",
            "caminho_js" => URL . "views/layout" . DS . DEFAULT_LAYOUT . "/js/",
            "caminho_html" => URL . "views/layout" . DS . DEFAULT_LAYOUT . "/img/",
            "caminho_fontes" => URL . "views/layout" . DS . DEFAULT_LAYOUT . "/font-awesome/",
            "menu" => $menu,
            "admin" => $admin,
            "js" => $js,
            "css" => $css,
        );



//        $layoutParam=array(
//                "caminho_css"=>URL."views/layout".DS.DEFAULT_LAYOUT."/css/",
//                "caminho_js"=>URL."views/layout".DS.DEFAULT_LAYOUT."/js/",
//                "caminho_html"=>URL."views/layout".DS.DEFAULT_LAYOUT."/img/",
//                "caminho_fontes"=>URL."views/layout".DS.DEFAULT_LAYOUT."/font-awesome/",
//                "menu"=>$menu,
//                "js"=>$js,
//                "css"=>$css,
//                "item"=>$item,
//                "URL"=>URL,
//                "config"=>array(
//                "APP_NAME" =>APP_NAME,
//                "APP_DESCRICAO"=>APP_DESCRICAO,
//                "DESENVOLVEDOR"=>DESENVOLVEDOR,
//                "COMPANY"=>COMPANY    
//                )
//            );
//        

        $caminho = ROOT . "views" . DS . $this->_controller . DS . $nome . ".phtml"; //ou phtml
        $header = ROOT . "views" . DS . "layout" . DS . DEFAULT_LAYOUT . DS . "header.php";
        $footer = ROOT . "views" . DS . "layout" . DS . DEFAULT_LAYOUT . DS . "footer.php";
        if (is_readable($caminho)) {
            require $header;
            //$this->assign("conteudo",$caminho);
            require $caminho;
//            require $footer;
        } else {

            throw new Exception("erro da view");
        }

//        $this->assign("_layoutParam",$layoutParam);
//        $this->display('template.tpl');
//        
    }

    public function setJs(array $js) {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = URL . "views/" . $this->_controller . "/js/" . $js[$i] . ".js";
            }
        } else {
            throw new Exception("Erro de Javascript");
        }
    }

    public function setCss(array $css) {
        if (is_array($css) && count($css)) {
            for ($i = 0; $i < count($css); $i++) {
                $this->_css[] = URL . "views/" . $this->_controller . "/css/" . $css[$i] . ".css";
            }
        } else {
            throw new Exception("Erro de Css");
        }
    }

}
