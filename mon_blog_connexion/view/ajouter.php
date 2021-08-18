<?php 
    $titre_page = 'Ajouter un article - Mon blog';
    ob_start();
?>
    <main class="bg-color-2">
        <section class="wrapper flex col">
            <h3 class="size-3 margin-0">Ajouter un article</h3>
            <form action="" method="post">
                <div class="field flex col">
                    <label for="titre">Titre de l'article :</label>
                    <input type="text" name="titre" id="titre">
                </div>
                <div class="field">
                    <p>Contenu de l'article :</p>
                    <textarea name="contenu" id="contenu"></textarea>
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </section>
    </main>
<?php 
    $contenu_main = ob_get_clean();
    require('template.php'); 
?>