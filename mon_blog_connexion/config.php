<?php

define('FROMINDEX', NULL);

$debug = true;

if($debug){
    define('DBNAME', 'mon_blog');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASSWORD', '');
}else{
    // A definir quand sur serveur
}