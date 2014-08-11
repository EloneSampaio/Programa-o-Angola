<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author sam
 */
class Model{
    //put your code here
    protected $db;
    public function __construct() {
    $this->db= new Database(DB_TYPE,DB_HOST,DB_NOME,DB_USER,DB_PASS);
}
   
    
    
}
