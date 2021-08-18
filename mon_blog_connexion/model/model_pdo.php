<?php

    try{

        $dst = 'mysql:host =' . DBHOST . ';dbname=' . DBNAME;
        $user = DBUSER;
        $password = DBPASSWORD;
        $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $bdd = new PDO($dst, $user, $password, $options);

    }catch(Exeption $e){

        die('Erreur : ' . $e->getMessage());

    }