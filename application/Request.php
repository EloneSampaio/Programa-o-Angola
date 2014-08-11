<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author sam
 */
class Request {
    //put your code here
    /**
     * @name $controller
     * @name $metodo
     * @name $parametros
     */
    
    private $_controller;
    private $_metodo;
    private $parametros;
    
    
    public function __construct() {
        if(isset($_GET["url"])){
            $url=  filter_input(INPUT_GET, "url",FILTER_SANITIZE_URL);
            $url=  explode("/", $url);
            $url=  array_filter($url);
            array_filter($url);
            $this->_controller= strtolower(array_shift($url));
            $this->_metodo= strtolower(array_shift($url));
            $this->parametros=$url;
            
            
        }
            
          if(!$this->_controller){
              
              $this->_controller=DEFAULT_CONTROLLER;
          }   
          
          if (!$this->_metodo){
              $this->_metodo="index";
          }
          
          if (!isset($this->parametros)){
             
              $this->parametros=array();
          }
     
    }
    
    
    /**
     * @return objecto metodo que retorna o controller
     */
    public function getController(){
        return $this->_controller;
    
      }
      
      
       /**
     * @return objecto metodo que retorna o Metodo
     */
    public function getMetodo(){
        return $this->_metodo;
    
      }
      
       /**
     * @return objecto metodo que retorna os Parametros
     */
    public function getParametros(){
        return $this->parametros;
    
      }
}