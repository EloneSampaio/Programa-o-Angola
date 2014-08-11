<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author sam
 */
class Session {

    //put your code here


    public static function iniciar() {
        session_start();
    }

    public static function set($key, $valor) {
        if (!empty($key)) {
            $_SESSION[$key] = $valor;
        }
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function destruir($valor = FALSE) {

        if ($valor) {
            if(is_array($valor)) {
                for($i=0; $i<count($valor); $i++) {
                if(isset($_SESSION[$valor[$i]])){
                        
                unset($_SESSION[$valor[$i]]);
                    
                }
                       
                        unset($_SESSION[$valor[$i]]);
                    }
                }
             
            
            else {
                if (isset($_SESSION[$valor])) {
                    unset($_SESSION[$valor]);
                }
            }
        } 
        
        else {
            session_destroy();
        }
    }

    public static function nivel($nivel) {
        
        if (!Session::get("autenticado")) {
            header("location: ".URL."error/acesso/5050");
            exit;
        }
       if(Session::getNivel($nivel) > Session::getNivel(Session::get('nivel'))) {
          header("location: ".URL."error/acesso/5050");
           exit;
        }
    }
    
    public static function nivelView($nivel){
        
        if(!Session::get('autenticado')){
            return FALSE;
        }
        if(Session::getNivel($nivel) > Session::getNivel(Session::get('nivel'))) {
            return FALSE;
        }
        
        return TRUE;
        }

    public static function getNivel($nivel) {
        $user['usuario'] = 1;
        $user['colab'] = 2;
        $user['admin'] = 3;
        if (!array_key_exists($nivel, $user)) {
            throw new Exception("Erro de Acesso");
        }
        else {
            return $user[$nivel];
        }
    }
    
    
    public static function nivelRestrito(array $nivel, $admin=FALSE){
        if(!Session::get('autenticado')){
             header("location: ".URL."error/acesso/5050");
           exit;
        }
        
        Session::tempo();
        if($admin==FALSE){
          if(Session::get("nivel")=="admin"){
              return;
          }
        }
        
        if(count($nivel)){
            if(in_array(Session::get('nivel'), $nivel)){
                return;
            }

        }
    header("location: ".URL."error/acesso/5050");
    
    }
    
    
    public static function nivelViewRestrito(array $nivel,$admin=FALSE){
         if(!Session::get('autenticado')){
            return FALSE;
        }
       
        if($admin==FALSE){
          if(Session::get("nivel")=="admin"){
              return TRUE;
          }  
    }
    
    if(count($nivel)){
            if(in_array(Session::get('nivel'), $nivel)){
                return TRUE ;
            }
        }
    
        return FALSE;
            }
            
     
    public static function tempo(){
                if(!Session::get('time') || !defined("SESSION_TIME")){
                    throw new Exception("Não foi definido nenhum tempo para Sessão");
                }
                if(SESSION_TIME==0){
                    return;
                }
                if(time()- Session::get('time')>SESSION_TIME * 60){
                    Session::destruir();
                    header("location:" .URL."error/acesso/8080");
                }
                else{
                    Session::set("time", time());
                }
            }



}
