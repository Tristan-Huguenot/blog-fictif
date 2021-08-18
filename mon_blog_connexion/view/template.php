<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?= $titre_page ?></title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>
        
    
        <header class=" bg-color-1">
            <div class="wrapper flex row space-between al-it-ce">
                <a href="index.php">    
                    <img class="logo" src="public/img/logo/logo_monblog.png" alt="Mon blog">
                </a>
                <div class="titre_page flex col space-evenly al-it-ce">
                    <h1 class="size-1">Mon super blog</h1>
                    <h2 class="size-2">Administration</h2>
                </div>

                <div class="flex col">
                
                <?php if(isset($_SESSION['login']) && !empty($_SESSION['login'])) : ?>

                    <p>Bonjour <?= htmlspecialchars(ucfirst($_SESSION['login'])) ?> </p>
                    <a href="index.php?page=deconnexion" class="al-se-fe">Se deconnecter</a>
                    
                <?php endif; ?>

                </div>

                

            </div>
        </header>

        <?php 
            require_once 'view/inc/tools.php';
            $message = handleSessionMessage();
            if($message){
        ?>

            <div id="session_message" class="flex row al-it-ce">
                <p class="<?= $message['type'] ?>"><?= $message['text'] ?></p>
                <img id="croix_session_message" src="public/img/icon/croix.svg" alt="Fermer" width="20px" height="20px">
            </div>
                
            <script src="public/js/session_message.js"></script>

        <?php } ?>
        

        <?= $contenu_main ?>

        
    </body>
</html>