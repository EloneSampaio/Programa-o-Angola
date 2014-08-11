<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoriaModel
 *
 * @author sam
 */
class comentarioModel extends Model{
    //put your code here
    
        public function __construct() {
        parent::__construct();
    }
    
    
    public function novo_comentario($data){
        $novo=$this->db->Inserir(
                "tbl_comentarios",
                array( 
                    'nome'=>$data['nome'],
                    'msg'=>$data['comentario'],
                    'data'=>  date("Y-m-d"),
                    'tbl_tutorial_id_tutorial'=>1
                    
                    
                ));
              }
 
   
    public function listar_comentario()
	{
		return $this->db->Selecionar('SELECT * FROM tbl_comentarios ORDER BY id_comentario DESC');
	}
    
    
    
    
    public function listar_id($id){
      return  $this->db->Selecionar('SELECT  * FROM tbl_comentarios WHERE id_comentario=:id ',array(':id' => $id));
    }
    

        public function apagar_comentario($id)
	{
            $this->db->apagar('tbl_comentarios', "id_comentario = '$id'");
	}


    
    public function editar_comentario($data){
        
        $data=array(
               
               'nome'=>$data['nome'],
               'comentario'=>$data['comentario']
                );
        
        $this->db->Actualizar('tbl_comentarios',$data,"`id_comentario`={$data['id']}");
    }
    
     public function verificar_comentario($comentario){
       $em=$this->db->prepare("SELECT id_comentario FROM tbl_comentarios WHERE nome=:nome");
       
       $em->execute(array(
             ':nome'=> $comentario,
                ));
       return $em->fetch(); 
   }//fim
    
    
}
