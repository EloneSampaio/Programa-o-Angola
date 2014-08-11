<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hash
 *
 * @author sam
 */
class Hash {
    //put your code here
    
    public static function getHash($algoritimo,$data,$chave){
        $hash= hash_init($algoritimo,HASH_HMAC,$chave);
        hash_update($hash, $data);
        return hash_final($hash);
    }
}
