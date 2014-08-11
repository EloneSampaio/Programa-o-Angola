<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_Model
 *
 * @author sam
 */
class loginModel extends Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function login($dados){
      
        $novo=$this->db->prepare("SELECT * FROM tbl_usuarios WHERE email=:email AND senha=:senha");
        $novo->execute(array(
             ':email'=> $dados['email'],
             ':senha'=>Hash::getHash('md5',$dados['senha'] ,HASH_KEY) //$dados['senha'] 
                ));
               return $novo->fetch();
              
                
        }//fim
}
