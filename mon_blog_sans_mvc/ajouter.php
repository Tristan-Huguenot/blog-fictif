<?php 

    session_start();
    
    require_once 'model/model.php';

    require_once 'inc/tools.php';

    if(isset($_POST['titre'], $_POST['contenu'])){

        if(empty($_POST['titre']) || empty($_POST['contenu'])){

            $_SESSION['message'] = ['type' => 'success', 'text' => 'Vous devez remplir tous les champs'];

        }else{

            ajouterBillet($bdd, htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']));

            $_SESSION['message'] = ['type' => 'success', 'text' => 'L\'article a bien été ajouté'];

            header('Location: index.php');

        }

    }

?>

<?php require_once 'inc/header.php'; ?>

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
    require_once 'inc/footer.php';
?>