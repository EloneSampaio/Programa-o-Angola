<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define("URL", "http://aulas.dev/");
define("DEFAULT_LAYOUT", "default");
define("APP_NAME", "Programao Angola");
define("APP_DESCRICAO", "Trabalhando Para Melhorar O Conceito de Programação em Angola");
define("DESENVOLVEDOR", "SamEngenner");
define("COMPANY", "Sam&&Eletronicos");
define("SESSION_TIME", "50");
define("HASH_KEY", "peixede234luanda1298");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
define("APP_PATH", ROOT . "application" . DS);
define("DEFAULT_ERRO", "errorController");
require APP_PATH . "Bootstrap.php";
require APP_PATH . "Controller.php";
require APP_PATH . "Database.php";
require APP_PATH . "Hash.php";
require APP_PATH . "Model.php";
require APP_PATH . "Session.php";
require APP_PATH . "View.php";
require APP_PATH . "Request.php";
require APP_PATH . "Config.php";
//require APP_PATH."Acl.php";