<?php


class ErrorController extends Controller{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    public function index() {
        $this->view->titulo="PAGINA DE ERRO";
        $this->view->mensagem_erro=  $this->getError();
        $this->view->renderizar("index");
    }
    
    private function getError($codigo=FALSE){
        if($codigo){
        $codigo=  $this->filtraInt($codigo);
        if(is_int($codigo)){
            $codigo=$codigo;
        }
        }
         else {
             $codigo="default";
         }
        $erro['default']="Ocorreu um erro. A Pagina não pode ser mostrada";
        $erro['5050']="Acesso Restringido";
        $erro['8080']="Tempo da Sessão Expirou";
    
        if(array_key_exists($codigo, $erro)){
            
            return $erro[$codigo];
        }
        else{
             return $erro['default'];
        }
    }
    
    
    public function acesso($codigo){
        $this->view->titulo="PAGINA DE ERRO";
        $this->view->mensagem_erro=  $this->getError($codigo);
        $this->view->renderizar("acesso");
    
        
    }
    
    
    
}


?>