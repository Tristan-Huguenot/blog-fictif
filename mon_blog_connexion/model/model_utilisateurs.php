<?php

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
     * Retourne si oui (1) ou non (0) l'utilisateurs est administrateur (Droit de CRUD ou juste R)
     * @param PDO $bdd objet connexion à la bdd
     * @param string $login le nom d'utilisateur pour trouvé le mdp associé
     * @return int $estAdmin 0 ou 1
     */
    function retourneAdministrateur(PDO $bdd, string $login){

        $sql = 'SELECT utilisateurs.administrateur
        FROM utilisateurs
        WHERE utilisateurs.login = ?';

        $q = $bdd->prepare($sql);
        $q->execute(array($login));
        $estAdmin = $q->fetchColumn();
        $q->closeCursor();

        return $estAdmin;
    }