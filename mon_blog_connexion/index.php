<?php

    session_start();

    require_once 'config.php';

    $controller = 'bo';

    if(isset($_SESSION['login']) && !empty($_SESSION['login'])){

        if(!isset($_GET['page'])){

            $page = 'home';

        }else{

            switch($_GET['page']){
                case 'visionner':
                    $page = 'visionner';
                    break;
                case 'ajouter':
                    $page = 'ajouter';
                    break;
                case 'modifier':
                    $page = 'modifier';
                    break;
                case 'supprimer':
                    $page = 'supprimer';
                    break;
                case 'deconnexion':
                    $page = 'deconnexion';
                    break;
                default:
                    $page = 'home';
            }

        }

    }else{

        $page = 'connexion';

    }

    require_once 'controller/controller_' . $controller . '.php';

    $page($bdd);