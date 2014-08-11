<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrarModel
 *
 * @author sam
 */
class registrarModel extends Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar($data){
        $codigo=rand("125436778", "88888888");
          $this->db->Inserir("tbl_usuarios",array(
               'p_nome'=>$data['p_nome'],
               'u_nome'=>$data['u_nome'],
               'email'=>$data['email'],
               'senha'=>  Hash::getHash('md5',$data['senha'] ,HASH_KEY),
               'usuario'=>$data['usuario'],
               'data'=>  time(),
               'codigo'=>$codigo
           ));
    }
    
    public function Verificar_Email($email){
       $em=$this->db->prepare("SELECT * FROM tbl_usuarios WHERE email=:email");
       
       $em->execute(array(
             ':email'=> $email,
                ));
       return $em->fetch(); 
   }//fim

   
    public function listar_usuario()
	{
		return $this->db->Selecionar('SELECT * FROM tbl_usuarios ORDER BY id_usuario DESC');
	}
   
   
    public function Verificar_Usuario($usuario){
       $id=$this->db->prepare("SELECT id_usuario,codigo FROM tbl_usuarios WHERE usuario=:usuario");
      
       $id->execute(array(
             ':usuario'=> $usuario,
                ));
       return $id->fetch(); 
   }//fim
    
   
    public function Get_Usuario($usuario,$codigo){
       $t=$this->db->prepare("SELECT * FROM tbl_usuarios WHERE usuario=:usuario AND codigo=:codigo");
       $t->bindValue(":usuario",$usuario);
       $t->bindValue(":codigo",$codigo);
       $t->execute();
       return $t->fetch(); 
   }//fim
   
    
    public function Activar_Usuario($id,$codigo){
       $t=$this->db->prepare("update tbl_usuarios set estatos=1 where  id_usuario=:id_usuario AND codigo=:codigo");
       $t->bindValue(":id_usuario",$id);
       $t->bindValue(":codigo",$codigo);
       $t->execute();
        
    }
   
   
}
