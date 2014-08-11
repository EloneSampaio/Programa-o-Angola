<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginController
 *
 * @author sam
 */
class LoginController extends Controller{
    //put your code here
    
    private $_login;
    public function __construct() {
        parent::__construct();
        $this->_login=  $this->LoadModelo('login');
    }
    
    public function index() {
        
        $this->view->setJs(array("novo"));
        $this->view->setCss(array("style")); 
        $this->view->titulo="Iniciar Sessão";
        if($this->getInt('enviar')==1){
        $this->dados=$_POST;    
        if(!$this->verificarEmail('email')){ 
            $this->view->erro="POrfavor Introduza um Email Valido";
            $this->view->renderizar("index"); 
            exit;
        }
        if(!$this->getSqlverifica('senha')){ 
            $this->view->erro="POrfavor Introduza uma senha Valida";
            $this->view->renderizar("index"); 
            exit;
        }
        $data=array();
        $data['senha']=$this->getSqlverifica('senha') ;
        $data['email']=$this->verificarEmail('email');
        $linha=$this->_login->login($data);

        if(!$linha){
            $this->view->erro="Usuario ou Palavra Passe Incorreta";
          $this->view->renderizar("index"); 
            exit;
        }
        if($linha['status']!=1){
            $this->view->erro="Esse Usuario Não Esta Activo";
             $this->view->renderizar("index"); 
            exit;
        }
        Session::set("autenticado", true);
        Session::set('nivel', $linha['nivel']);
        Session::set('nome', $linha['nome']);
        Session::set('id_usuario', $linha['id_usuario']);
        Session::set('time', time());
        $this->redirecionar();
      }
        
        $this->view->renderizar("index");
}
    public function logof(){
      Session::destruir(array('autenticado','nivel','nome','id_usuario','time'));
      $this->redirecionar("login");
    }
    
}
