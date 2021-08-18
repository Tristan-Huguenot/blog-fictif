<?php 
    session_start();

    require_once 'model/model.php';

    if(isset($_POST['login'], $_POST['mdp'])){

        if(empty($_POST['login']) || empty($_POST['mdp'])){

            $_SESSION['message'] = ['type' => 'warning', 'text' => 'Vous devez remplir tous les champs'];

        }else{

            $mdp = retourneMdp($bdd, strtolower($_POST['login']));

            if(password_verify($_POST['mdp'], $mdp)){

                $_SESSION['login'] = strtolower($_POST['login']);
                header('Location: index.php');

            }else{

                $_SESSION['message'] = ['type' => 'warning', 'text' => 'Le login et/ou le mot de passe est incorrect !'];

            }

        }

    }

?>

<?php require_once 'inc/header.php'; ?>

<main class="bg-color-2">
    <section class="wrapper flex col">
        <h3 class="size-3 margin-0">Se connecter</h3>

        <form action="" method="post">
    
            <div class="field">
                <label for="login">Nom d'utilisateur :</label>
                <input type="text" name="login" id="login">
            </div>
            <div class="field">
                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp">
                <img src="public/img/icon/closed_eye.svg" alt="Mot de passe caché" id="oeilmdp">
            </div>
            <input type="submit" value="Se connecter">

        </form>
    </section>
</main>

<script src="public/js/connexion.js"></script>

<?php 
    require_once 'inc/footer.php';
?>