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
class tutorialModel extends Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function novo_tutorial($data, $imagem) {
        $novo = $this->db->Inserir(
            "tbl_tutorial", array(
            'categoria' => $data['categoria'],
            'tbl_usuarios_id_usuario' => Session::get('id_usuario'),
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'],
            'destaque' => $data['destaque'],
            'msg' => $data['msg'],
            'img' => $imagem,
            'data' => date('Y-m-d H:i:s'),
            'status' => $data['status']
        ));
    }

    public function listar_tutorial() {
        return $this->db->Selecionar('SELECT * FROM tbl_tutorial ORDER BY id_tutorial DESC');
    }

    public function listar_id($id) {
        return $this->db->Selecionar('SELECT  * FROM tbl_tutorial WHERE id_tutorial=:id ', array(':id' => $id));
    }

    public function apagar_tutorial($id) {
        $this->db->apagar('tbl_tutorial', "id_tutorial = '$id'");
    }

    public function editar_tutorial($data) {

        $data = array(
            "tbl_tutorial",
            'categoria' => $data['categoria'],
            'tbl_usuarios_id_usuario' => Session::get('id_usuario'),
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'],
            'destaque' => $data['destaque'],
            'msg' => $data['msg'],
            'data' => date('Y-m-d H:i:s'),
            'status' => $data['status'],
            
        );
       

        $this->db->Actualizar('tbl_tutorial', $data, "`id_tutorial`={$data['id']}");
    }

    public function verificar_tutorial($valor) {
        $em = $this->db->prepare("SELECT id_tutorial FROM tbl_tutorial WHERE titulo=:titulo");

        $em->execute(array(
            ':titulo' => $valor,
        ));
        return $em->fetch();
    }

//fim
}
