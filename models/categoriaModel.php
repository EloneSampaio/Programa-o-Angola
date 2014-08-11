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
class categoriaModel extends Model{
    //put your code here
    
        public function __construct() {
        parent::__construct();
    }
    
    
    public function nova_categoria($data,$imagem){
        $novo=$this->db->Inserir(
                "tbl_categorias",
                array( 
                    'nome'=>$data['nome'],
                    'descricao'=>$data['descricao'],
                    'img'=>$imagem
                ));
              }
 
   
    public function listar_categoria()
	{
		return $this->db->Selecionar('SELECT * FROM tbl_categorias ORDER BY id_categoria DESC');
	}
    
    
    
    
    public function listar_id($id){
      return  $this->db->Selecionar('SELECT  * FROM tbl_categorias WHERE id_categoria=:id ',array(':id' => $id));
    }
    

        public function apagar_categoria($id)
	{
            $this->db->apagar('tbl_categorias', "id_categoria = '$id'");
	}


    
    public function editar_categoria($data){
        
        $data=array(
               
               'nome'=>$data['nome'],
               'descricao'=>$data['descricao']
                );
        
        $this->db->Actualizar('tbl_categoria',$data,"`id_categoria`={$data['id']}");
    }
    
     public function verificar_categoria($categoria){
       $em=$this->db->prepare("SELECT id_categoria FROM tbl_categorias WHERE nome=:nome");
       
       $em->execute(array(
             ':nome'=> $categoria,
                ));
       return $em->fetch(); 
   }//fim
    
    
}
