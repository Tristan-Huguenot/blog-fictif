<?php 
    $titre_page = htmlspecialchars($billet['titre']) . ' - Mon blog';
    ob_start();
?>
    <main class="bg-color-2">
        <div class="wrapper flex col">
            <section class='flex row'>
                <h3 class="size-3 margin-0"><?= htmlspecialchars($billet['titre']) ?></h3>
                <div class="flex row space-evenly">
                            <a class="liens_article" href="index.php?page=<?= urlencode('modifier') ?>&id=<?= $billet['id'] ?>"><img src="public/img/icon/crayon.svg" alt="Modifier l'article" class="icone"></a>
                            <a class="liens_article" href="index.php?page=<?= urlencode('supprimer') ?>&id=<?= $billet['id'] ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer cet article ?')"><img src="public/img/icon/croix.svg" alt="Supprimer l'article" class="icone"></a>                            
                </div>
            </section>
            <blockquote><?= htmlspecialchars($billet['date_creation_billet']) ?></blockquote>
            <p class="size-6"><?= htmlspecialchars($billet['contenu']) ?></p>
            <section>
                <h4 class="size-4">Commentaires</h4>
                <div class="commentaires">
                    <?php foreach($commentaires as $commentaire){?>
                        <section class="flex row commentaire al-it-ce">
                            <div class="flex col auteur_commentaire space-between">
                                <h5 class="size-6 margin-0 te-al-ce"><?= $commentaire['auteur'] ?></h5>
                                <blockquote class="date_commentaire"><?= $commentaire['date_creation_commentaire'] ?></blockquote>
                            </div>
                            <p><?= $commentaire['commentaire'] ?></p>
                        </section>
                    <?php } ?>
                </div>
        </section>
        </div>
        
    </main>
<?php 
    $contenu_main = ob_get_clean();
    require('template.php'); 
?>