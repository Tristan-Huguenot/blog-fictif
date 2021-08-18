<?php 
    $titre_page = 'Liste des articles - Mon blog';
    ob_start();
?>

<main class="bg-color-2">
    <section class="wrapper flex col">
        <h3 class="size-3 margin-0">Liste des articles :</h3>
        <a class="al-se-ce" href="index.php?page=<?= urlencode('ajouter') ?>">Ajouter un article</a>
        <table class="tableau_articles">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Contenu</td>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($billets as $billet) { ?>
                    <tr>
                        <td><?= htmlspecialchars($billet['titre']) ?></td>
                        <td><?= htmlspecialchars(substr($billet['contenu'], 0, 50)) ?></td>
                        <td><?= htmlspecialchars($billet['date_creation_billet']) ?></td>
                        <td class="flex row space-evenly">
                            <a class="liens_article" href="index.php?page=<?= urlencode('visionner') ?>&id=<?= $billet['id'] ?>"><img src="public/img/icon/yeux.svg" alt="Voir l'article" class="icone"></a>
                            <a class="liens_article" href="index.php?page=<?= urlencode('modifier') ?>&id=<?= $billet['id'] ?>"><img src="public/img/icon/crayon.svg" alt="Modifier l'article" class="icone"></a>
                            <a class="liens_article" href="index.php?page=<?= urlencode('supprimer') ?>&id=<?= $billet['id'] ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer cet article ?')"><img src="public/img/icon/croix.svg" alt="Supprimer l'article" class="icone"></a>                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<script src="public/js/suppression.js"></script>

<?php 
    $contenu_main = ob_get_clean();
    require('template.php'); 
?>