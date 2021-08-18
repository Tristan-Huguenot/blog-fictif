<?php 
    $titre_page = 'Connexion - Mon blog';
    ob_start();
?>

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
    $contenu_main = ob_get_clean();
    require('template.php'); 
?>