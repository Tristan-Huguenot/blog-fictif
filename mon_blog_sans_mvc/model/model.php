<?php

try{

    $dst = 'mysql:host=localhost;dbname=mon_blog';
    $user = 'root';
    $password = '';
    $options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $bdd = new PDO($dst, $user, $password, $options);

}catch(Exeption $e){

    die('Erreur : ' . $e->getMessage());

}

    /**
     * Retourne le mot de passe haché associé au login
     * @param PDO $bdd objet connexion à la bdd
     * @param string $login le nom d'utilisateur pour trouvé le mdp associé
     * @return string $mdp le mot de passe haché associé au $login
     */
    function retourneMdp(PDO $bdd, string $login){

        $sql = 'SELECT utilisateurs.mdp
        FROM utilisateurs
        WHERE utilisateurs.login = ?';

        $q = $bdd->prepare($sql);
        $q->execute(array($login));
        $mdp = $q->fetchColumn();
        $q->closeCursor();

        return $mdp;

    }

    /**
     * Retourne un ou tous les billets de la base de données
     * @param PDO $bdd objet connexion à la bdd
     * @param int $id id du billet, null = tous les billets
     * @return array les billets ou un seul si $id est renseigner
     */
    function billet(PDO $bdd, int $id = NULL){

        if($id != NULL && $id <= 0) throw new Exception('billet() attends un nombre strictement supérieur à 0', E_USER_WARNING);

        $sql = 'SELECT billets.id, billets.titre, billets.contenu, DATE_FORMAT(date_creation, "Le %e/%m/%Y à %Hh%i") AS date_creation_billet
        FROM billets
        WHERE billets.id LIKE :id_billet
        ORDER BY billets.date_creation DESC';

        $q = $bdd->prepare($sql);
        $q->execute(array(
            'id_billet' => ($id != NULL) ? $id : '%',
        ));

        if($id != NULL) return $q->fetch(PDO::FETCH_ASSOC);

        return $q->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Retourne tous les commentaires associé à un billet
     * @param PDO $bdd objet connexion bdd
     * @param int $id id du billet
     * @param bool $ascend ordre des billets par rapport à la date de création, par defaut DESC (false) le plus vieux en premier
     * @return array les commentaires associé au billet $id
     */
    function commentairesBillet(PDO $bdd, int $id){

        if($id <= 0) throw new Exception('billet() attends un nombre strictement supérieur à 0', E_USER_WARNING);

        $sql = 'SELECT commentaires.id, commentaires.auteur, commentaires.commentaire, DATE_FORMAT(date_commentaire, "Le %e/%m/%Y à %Hh%i") AS date_creation_commentaire
        FROM commentaires
        WHERE commentaires.id_billet = :id_billet
        ORDER BY commentaires.date_commentaire DESC';

        $q = $bdd->prepare($sql);
        $q->execute(array(
            'id_billet' => $id,
        ));

        return $q->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Permet d'ajouter un billet à la bdd
     * @param PDO $bdd objet connexion bdd
     * @param string $titre le titre du billet
     * @param string $contenu contenu du billet
     * @return bool true ou false, est ce que la requete à aboutie
     */
    function ajouterBillet(PDO $bdd, string $titre, string $contenu){

        $sql = 'INSERT INTO billets(titre, contenu)
        VALUE(:titre, :contenu)';

        $q = $bdd->prepare($sql);
        $q->bindParam('titre', $titre);
        $q->bindParam('contenu', $contenu);
        return $q->execute();

    }

    /**
     * Permet de modifier un billet
     * @param PDO $bdd objet connexion bdd
     * @param string $titre le nouveau titre du billet
     * @param string $contenu le nouveau contenu du billet
     * @param int $id id du billet à modifier
     * @return bool true ou false, est ce que la requete à aboutie
     */
    function modifierBillet(PDO $bdd, string $titre, string $contenu, int $id){

        if($id <= 0) throw new Exception('billet() attends un nombre strictement supérieur à 0', E_USER_WARNING);

        $sql = 'UPDATE billets
        SET billets.titre = :titre, billets.contenu = :contenu
        WHERE billets.id = :id_billet';

        $q = $bdd->prepare($sql);
        $q->bindParam('titre', $titre);
        $q->bindParam('contenu', $contenu);
        $q->bindParam('id_billet', $id, PDO::PARAM_INT);

        return $q->execute();

    }


    /**
     * Supprime un billet de la bdd
     * @param PDO $bdd objet connexion bdd
     * @param int $id id du billet à supprimer
     * @return bool true ou false, est ce que la requete à aboutie
     */
    function supprimerBillet(PDO $bdd, int $id){

        if($id <= 0) throw new Exception('billet() attends un nombre strictement supérieur à 0', E_USER_WARNING);

        $sql = 'DELETE
        FROM billets
        WHERE billets.id = :id_article';

        $q = $bdd->prepare($sql);
        $q->bindParam('id_article', $id);

        return $q->execute();

    }