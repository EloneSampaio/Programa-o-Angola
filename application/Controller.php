<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author sam
 */
abstract class Controller {
    //put your code here

    protected $view;
    protected $acl;


    public function __construct() {
       
        $this->view=new View(new Request);
    }
    
    protected function LoadModelo($modelo){
        $modelo=$modelo."Model";
        $caminho=ROOT."models".DS.$modelo.".php";
        if (is_readable($caminho)):
            require $caminho;
          $modelo=new $modelo;
          return $modelo;
          else :
              throw new Exception("Erro No Modelo");
          endif;
    }
    
    
    protected function getBibliotecas($lib){
        $caminho=ROOT."libs".DS.$lib.".php";
        if(is_readable($caminho)):
            require $caminho;
        else:
            throw new Exception("Erro ao Ler Biblioteca");
        endif;
        
    }
    
    protected function getTexto($chave){
        if(isset($_POST[$chave])&&!empty($_POST[$chave])):
            $_POST[$chave]=  htmlspecialchars($_POST[$chave], ENT_QUOTES);
            return $_POST[$chave];
        endif;
        return "";
    }
    
     protected function getInt($chave){
        if(isset($_POST[$chave])&&!empty($_POST[$chave])):
            $_POST[$chave]= filter_input(INPUT_POST, $chave,FILTER_VALIDATE_INT);
            return $_POST[$chave];
        endif;
        return 0;
    }
    
    
    protected function filtraInt($int){
        $int=(int)$int;
        if(is_int($int)):
            return $int;
        else:
            return 0;
        endif;
    }
    
    
    protected function getSqlverifica($chave){
        if(isset($_POST[$chave])&&!empty($_POST[$chave])){
            $_POST[$chave]= strip_tags($_POST[$chave]);
            if(!get_magic_quotes_gpc()){
              $_POST[$chave]= addslashes($_POST[$chave]);           
       }
            return trim($_POST[$chave]);
    }
    }
    
    
    
     protected function alphaNumeric($chave){
         if(isset($_POST[$chave])&&!empty($_POST[$chave])){
      $_POST[$chave]=(string) preg_replace('/[^A-Z0-9_]/i', '',  $_POST[$chave]);
       return  trim($_POST[$chave]); 
        }
    }
    
    protected function verificarEmail($chave){
         if(isset($_POST[$chave])&&!empty($_POST[$chave])){
           if(filter_var($_POST[$chave], FILTER_VALIDATE_EMAIL)){  
               return  trim($_POST[$chave]);
           } 
        }
    }


    protected function getPostParam($param){
        
        if(isset($_POST[$param])):
            return $_POST[$param];
        endif;
    }

    
    protected function redirecionar($caminho=FALSE){
        if($caminho){
            header("location:" .URL.$caminho);
            exit;
        }
        else{
            header("location:".URL);
            exit;
        }
    }
    
    
    public function getFooter($vista, $link = false)
	{
		$rutaView = ROOT."views".DS."layout".DS.DEFAULT_LAYOUT.DS.$vista.".php";
		
		if($link)
		$link = URL . $link . '/';
		
		if(is_readable($rutaView)){
			ob_start();
			
			include $rutaView;
			
			$contenido = ob_get_contents();
			
			ob_end_clean();
			
			return $contenido;
		}
		
		throw new Exception('Erro ao inserir Rodape');		
	}
    
    abstract public function index();
    
    
}
