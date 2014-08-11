<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {

    include 'config.php';

    Session::iniciar();

    Bootstrap::run(new Request());
} catch (Exception $ex) {
    echo $ex->getMessage();
}


        
