<?php

/**
 * Description of registrarController
 *
 * @author sam
 */
class RegistrarController extends Controller {

    //put your code here

    private $_registrar;

    public function __construct() {
        $this->_registrar = $this->LoadModelo('registrar');
        parent::__construct();
    }

    public function index() {

        if (Session::get('autenticado')) {
            $this->redirecionar();
        }
        $this->view->setJs(array("novo"));
        $this->view->setCss(array("style"));
        $this->view->titulo = "Cadastra-se no nosso Site";

        if ($this->getInt('enviar') == 1) {
            $this->view->dados = $_POST;

            if (!$this->getSqlverifica('p_nome')) {
                $this->view->erro = "POrfavor Introduza um nome Valido";
                $this->view->renderizar("index");
                exit;
            }
            if (!$this->getSqlverifica('u_nome')) {
                $this->view->erro = "POrfavor Introduza um nome Valido";
                $this->view->renderizar("index");
                exit;
            }

            if (!$this->getSqlverifica('usuario')) {
                $this->view->erro = "POrfavor Introduza um nome de usuario Valido";
                $this->view->renderizar("index");
                exit;
            }

            if (!$this->getSqlverifica('senha')) {
                $this->view->erro = "POrfavor Introduza uma senha Valida";
                $this->view->renderizar("index");
                exit;
            }

            if (!$this->verificarEmail('email')) {
                $this->view->erro = "POrfavor Introduza um Email Valido";
                $this->view->renderizar("index");
                exit;
            }

            $data = array();
            $data['p_nome'] = $this->getSqlverifica('p_nome');
            $data['u_nome'] = $this->getSqlverifica('u_nome');
            $data['usuario'] = $this->getSqlverifica('usuario');
            $data['senha'] = $this->getSqlverifica('senha');
            $data['c_senha'] = $this->getSqlverifica('c_senha');
            $data['email'] = $this->verificarEmail('email');

            if ($data['senha'] != $data['c_senha']) {
                $this->view->erro = "As Senhas Não Correspondem";
                $this->view->renderizar("index");
                exit;
            }

            $email = $this->_registrar->Verificar_Email($data['email']);
            if ($email) {
                $this->view->mensagem = "Já existe uma conta registrada nesta Conta de Email " . $email['email'] . "";
                $this->view->renderizar("index");
                exit;
            }


            if ($this->_registrar->Verificar_Usuario($this->alphaNumeric('usuario'))) {
                $this->view->erro = "O nome de usuario Já Existe";
                $this->view->renderizar("index");
                exit;
            }

//        $this->getBibliotecas('class.phpmailer');
//        $php_email=new PHPMailer();
//        
            $this->_registrar->registrar($data);

            if (!$this->_registrar->Verificar_Email($data['email'])) {
                $this->view->erro = "Não Possivel criar sua conta tenta mais tarde";
                $this->view->renderizar("index");
                exit;
            }

//        $php_email->From("http://www.programacaoangola.besaba.com/");
//        $php_email->FromName("Teste de Usuario");
//        $php_email->Subject("Activação de Conta");
//        $php_email->Body('Ola'.'<strong>'.$this->getSqlverifica('usuario').'</strong>'.
//                          '<p> Fizeste o registro em www.teste.com activa a tua conta clicando neste link'
//                
//                );
//        
//        $php_email->
            $this->view->dados = FALSE;
            $this->view->mensagem = "A sua conta foi criada com Sucesso";
        }
        $this->view->renderizar("index");
    }

}
