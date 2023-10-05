<?php

class ConnexionBDD
{
    private $host = 'localhost';
    private $dbname = 'restaurant';
    private $root = 'root';
    private $password = '';
    private $dbh;

    public function __construct()
    {
        $this->host = "localhost";
        $this->dbname = "restaurant";
        $this->root = "root";
        $this->password = "";
        $this->dbh = $this->connect();
    }

    /*
     * Méthode qui permet de préparer et d'éxcuter une requête
     */
    function prepareAndFetchAll($sql, $params = [])
    {
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($params);

            if ($stmt->rowCount() == 0)
                return [];
            else
                return $stmt->fetchAll();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }


    /*
     * Méthode qui permet de préparer et d'éxcuter une requête
     */
    function prepareAndFetchOne($sql, $params = [])
    {
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($params);

            if ($stmt->rowCount() == 0)
                return [];
            else
                return $stmt->fetch();
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function connect()
    {
        try {
            $db = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->root, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    /*
     *   Méthode pour récuperer l'utilisateur depuis la session
     *   si la méthode retourne NULL c'est que l'utilisateur
     *               n'est pas connecté.
     */
    function getUserFromSession()
    {
        if (!isset($_SESSION["user"])) {
            return null;
        }

        $user = $_SESSION["user"];

        $res = $this->prepareAndFetchAll(
            "SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :pass",
            [
                ":pseudo" => $user["pseudo"],
                ":pass" => $user["mot_de_passe"]
            ]
        );

        if (count($res) == 0)
            return NULL;

        $resultat = $this->login("mail", "mdp");
        if ($resultat) {
            // il est connecté.
        } else {
            // Il n'est pas connecté, les identifiants sont surement incorrects.
        }
        return $res[0];
    }


    public function login($email, $mdp)
    {
        $user = $this->prepareAndFetchOne(
            "SELECT * FROM utilisateur WHERE Email = :email AND Mot_de_passe = :mdp",
            [
                'email' => $email,
                'mdp' => password_hash($mdp, PASSWORD_BCRYPT)
            ]
        );

        if ($user !== []) {
            $_SESSION['utilisateur'] = $user;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register($email, $mdp)
    {
        $query = $this->dbh->prepare("INSERT INTO utilisateur (Login, Email, Mot_de_passe) VALUES ('', :email, :mdp)");
        $query->execute(['email' => $email, 'mdp' => $mdp]);
        $inscriptionValidee = $query->execute();
        if ($inscriptionValidee) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
