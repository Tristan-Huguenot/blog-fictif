<?php 
    session_start();

    if(isset($_GET['deconnexion'])) unset($_SESSION['login']);

    if(!isset($_SESSION['login']) || empty($_SESSION['login'])) header('Location: connexion.php');

    require_once 'model/model.php';

    require_once 'inc/tools.php';

    if(isset($_GET['supprimer'], $_GET['id']) && $_GET['id'] > 0){

        supprimerBillet($bdd, $_GET['id']);

        $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article a  bien été supprimé'];

    }
    
    if(isset($_GET['successmodifier'])){
        $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article a bien été ajouté'];
    }

    $billets = billet($bdd);

?>

<?php require_once 'inc/header.php'; ?>

<main class="bg-color-2">
    <section class="wrapper flex col">
        <h3 class="size-3 margin-0">Liste des articles :</h3>
        <a class="al-se-ce" href="ajouter.php">Ajouter un article</a>
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
                            <a class="liens_article" href="visionner.php?id=<?= $billet['id'] ?>"><img src="public/img/icon/yeux.svg" alt="Voir l'article" class="icone"></a>
                            <a class="liens_article" href="modifier.php?id=<?= $billet['id'] ?>"><img src="public/img/icon/crayon.svg" alt="Modifier l'article" class="icone"></a>
                            <a class="liens_article" href="index.php?supprimer&id=<?= $billet['id'] ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer cet article ?')"><img src="public/img/icon/croix.svg" alt="Supprimer l'article" class="icone"></a>                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>

<script src="public/js/suppression.js"></script>

<?php 
    require_once 'inc/footer.php';
?>