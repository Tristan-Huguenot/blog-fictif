<?php

    require_once 'model/model_pdo.php';

    require_once 'model/model_articles.php';

    require_once 'model/model_utilisateurs.php';

    function connexion($bdd){

        if(!isset($_POST['login'], $_POST['mdp'])) return require_once 'view/connexion.php';

        if(empty($_POST['login']) || empty($_POST['mdp'])){

            $_SESSION['message'] = ['type' => 'warning', 'text' => 'Vous devez remplir tous les champs' ];
            return require_once 'view/connexion.php';

        }

        $mdp = retourneMdp($bdd, strtolower($_POST['login']));

        if(password_verify($_POST['mdp'], $mdp)){

            $_SESSION['login'] = strtolower($_POST['login']);
            return header('Location: index.php');

        }

        $_SESSION['message'] = ['type' => 'warning', 'text' => 'Le login et/ou le mot de passe est incorrect'];

        return require_once 'view/connexion.php';

    }

    function deconnexion(){

        unset($_SESSION['login']);

        header('Location: index.php');

    }

    function verificationAdministrateur($bdd){

        $estAdmin = retourneAdministrateur($bdd, $_SESSION['login']);

        if(!$estAdmin){

            $_SESSION['message'] = ['type' => 'warning', 'text' => 'Vous n\'êtes pas autorisé à réaliser cet action'];

            return false;

        }

        return true;

    }

    function home($bdd){

        $billets = billet($bdd);

        require_once('view/home.php');

    }

    function visionner($bdd){

        if(!isset($_GET['id']) || $_GET['id'] <= 0) return header('Location: index.php');

        $billet = billet($bdd, $_GET['id']);

        $commentaires = commentairesBillet($bdd, $_GET['id']);

        require_once('view/visionner.php');

    }

    function ajouter($bdd){

        if(!verificationAdministrateur($bdd)) return header('Location: index.php');

        if(!isset($_POST['titre'], $_POST['contenu'])) return require_once 'view/ajouter.php';

        if(empty($_POST['titre']) || empty($_POST['contenu'])){

            $_SESSION['message'] = ['type' => 'warning', 'text' => 'Un des champs n\'a pas été rempli'];
            require_once 'view/ajouter.php';

        }else{

            if(ajouterBillet($bdd, htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']))){

                $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article à bien été ajouté'];
                header('Location: index.php');

            }else{

                $_SESSION['message'] = ['type' => 'warning', 'text' => 'Un des champs n\'a pas été rempli correctement'];
                require_once 'view/ajouter.php';

            }

        }

    }

    function modifier($bdd){

        if(!verificationAdministrateur($bdd)) return header('Location: index.php');

        if(!isset($_GET['id']) || $_GET['id'] <= 0) return header('Location: index.php');

        $billet = billet($bdd, $_GET['id']);

        if(!isset($_POST['titre'], $_POST['contenu'])) return require_once('view/modifier.php');

        if(empty($_POST['titre']) || empty($_POST['contenu'])){

            $_SESSION['message'] = ['type' => 'warning', 'text' => 'Un des champs n\'a pas été rempli'];
            return require_once 'view/modifier.php';

        }else{

            if(modifierBillet($bdd, htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']), $_GET['id'])){

                $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article a bien été modifié'];
                header('Location: index.php');

            }else{

                $_SESSION['message'] = ['type' => 'warning', 'text' => 'Un des champs n\'a pas été rempli correctement'];
                return require_once 'view/ajouter.php';

            }

        }

    }

    function supprimer($bdd){

        if(!verificationAdministrateur($bdd)) return header('Location: index.php');

        if(!isset($_GET['id']) || $_GET['id'] <= 0) return header('Location: index.php');

        $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article a bien été supprimer'];

        supprimerBillet($bdd, $_GET['id']);

        header('Location: index.php');

    }