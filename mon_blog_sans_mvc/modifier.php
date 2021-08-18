<?php 

    session_start();

    require_once 'model/model.php';

    require_once 'inc/tools.php';

    if(!isset($_GET['id']) || $_GET['id'] <= 0) header('Location: index.php');

    $billet = billet($bdd, $_GET['id']);

    if(isset($_POST['titre'], $_POST['contenu'])){

        if(empty($_POST['titre']) || empty($_POST['contenu'])){

            $_SESSION['message'] = ['type' => 'success', 'text' => 'Vous devez remplir tous les champs'];

        }else{

            modifierBillet($bdd, htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']), $_GET['id']);

            header('Location: index.php?successmodifier');

        }

    }

?>

<?php require_once 'inc/header.php'; ?>

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
    require_once 'inc/footer.php';
?>