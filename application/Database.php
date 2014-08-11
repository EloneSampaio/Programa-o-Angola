<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *host
 * @author sam
 */
class Database extends PDO {
    //put your code here
    
    public function __construct($DB_TYPE,$DB_HOST,$DB_NOME,$DB_USER,$DB_PASS) {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NOME,$DB_USER,$DB_PASS,
                 array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR
                    ));  
//        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXPECTION);
//    
        
        
    }
    
    
    public function Inserir($tabela,$sql){
        $this->beginTransaction();
        try{
            $this->commit();
        ksort($sql);
        $Campos_nome=  implode('`, `', array_keys($sql));
        $Campos_valor= ':'. implode(', :', array_keys($sql));
        $novo=$this->prepare("INSERT INTO $tabela ( `$Campos_nome`) VALUES ( $Campos_valor)");
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        foreach ($sql as $key => $valor) {
 
         $novo->bindValue(":$key", $valor);
        }
        
        $novo->execute();
        
        if($novo->rowCount()>0){
        $novo->setFetchMode(PDO::FETCH_ASSOC);
        return $novo->fetchAll(); 
        print json_encode($valor,JSON_PRETTY_PRINT);
        } 
      }
      catch (Exception $exc) {
           $this->rollBack();
           return $exc->getTraceAsString();
      }
}
        
        //fim

    public function Actualizar($tabela,$sql,$condicao){
        $this->beginTransaction();
        try{
            $this->commit();
        
        ksort($sql);
        $campos_detalhes=NULL;
        foreach ($sql as $key => $valor) {
        $campos_detalhes.=" `$key`=:$key,";
       
        }
        $campos_detalhes=  rtrim($campos_detalhes,','); 
        
        
        $novo=$this->prepare("UPDATE $tabela SET  $campos_detalhes WHERE $condicao");
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        foreach ($sql as $key => $valor) {
            $novo->bindValue(":$key", $valor);
            
        }
         $novo->execute();
        }
      catch (Exception $exc) {
           $this->rollBack();
           return $exc->getTraceAsString();
      }
    }//Fim
    
    
    public function Selecionar($sql,$array=array(),$fetchmodo=PDO::FETCH_ASSOC){
        $this->beginTransaction();
        try{
            $this->commit();
        $pesquisa=  $this->prepare($sql);
        foreach ($array as $key => $valor) {
        $pesquisa->bindValue("$key", $valor);    
        }
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $pesquisa->execute();
        return $pesquisa->fetchAll($fetchmodo);
         json_encode($valores);        
        }//Fim
    catch (Exception $exc) {
           $this->rollBack();
           return $exc->getTraceAsString();
    }
  }
    
       public function apagar($table, $where, $limit = 1)
	{
            $this->beginTransaction();
        try{
            $this->commit();
          $this->exec("DELETE  FROM $table WHERE $where LIMIT $limit");
        }
        catch (Exception $exc) {
           $this->rollBack();
           return $exc->getTraceAsString();
         }
     }

}
    
        
