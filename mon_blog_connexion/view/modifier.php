<?php 
    $titre_page = 'Modifier un article - Mon blog';
    ob_start();
?>
    <main class="bg-color-2">
        <section class="wrapper flex col">
            <h3 class="size-3 margin-0">Modifier un article</h3>
            <form action="" method="post">
                <div class="field flex col">
                    <label for="titre">Titre de l'article :</label>
                    <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($billet['titre']) ?>">
                </div>
                <div class="field">
                    <p>Contenu de l'article :</p>
                    <textarea name="contenu" id="contenu"><?= htmlspecialchars($billet['contenu']) ?></textarea>
                </div>
                <button type="submit">Modifier</button>
            </form>
        </section>
    </main>
<?php 
    $contenu_main = ob_get_clean();
    require('template.php'); 
?>