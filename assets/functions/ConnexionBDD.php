<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
class ConnexionBDD
{
    private $host = 'localhost';
    private $dbname = 'db_restoweb';
    private $root = 'root';
    private $password = '';
    private $dbh;

    public function __construct()
    {
        $this->host = "localhost";
        $this->dbname = "db_restoweb";
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
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            "SELECT * FROM user WHERE email = :email AND password = :password",
            [
                ":email" => $user["email"],
                ":password" => $user["password"]
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


    public function login($email, $password): bool
    {
        $user = $this->prepareAndFetchOne(
            "SELECT * FROM user WHERE email = :email",
            [
                ':email' => $email            ]
        );

        if($user === false || $user === []){
            return FALSE;
        }
        
        $passwordHash = $user["password"];
        if($password == NULL || $passwordHash == NULL){
            die("One of the passwords is null");
        }
        $verification = password_verify($password, $passwordHash);
        $_SESSION["user"] = $user;
        return $verification ;
    }

    public function register($email, $password): bool
    {
        $query = $this->dbh->prepare("INSERT INTO user (email,password) VALUES (:email, :password)");
        $inscriptionEstValidee = $query->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);

       return $inscriptionEstValidee;
    }

    /**
     * Cette fonction retourne true si le mail est déjà pris, false si il est pas déjà pris.
     * Utilisée pour éviter les collisions sur les adresses mail en base.
     * @return bool
     */
    public function verificationSiMailDejaPris($email): bool
    {
        if ($this->prepareAndFetchOne("SELECT email FROM user WHERE email = :email;", [":email" => $email])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function calculerTotalPanier($panier)
    {
        $total = 0;
        if(count($panier) == 0){
            return $total;
        }
        $ids = [];
        foreach ($panier as $p) {
            $ids[] = $p["id_produit"];
        }

        $imploded = implode(",", $ids);
        
        $produits = $this->prepareAndFetchAll("SELECT produit.prix_ht, produit.id_produit FROM produit WHERE produit.id_produit IN ($imploded);");


        foreach ($produits as $prod) {
            $prix = $prod["prix_ht"];
            $id = $prod["id_produit"];
            $qty = $this->rechercheQuantiteDansPanier($panier, $id);

            if ($qty != -1) {
                $prix = $qty * $prix;
                $total += $prix;
            }

        }
        return $total;
    }

    private function rechercheQuantiteDansPanier($panier, $idProduit)
    {
        foreach ($panier as $p) {
            if ($p["id_produit"] == $idProduit)
                return $p["qty"];
        }

        return -1;
    }

    public function insererCommandeEtProduitDepuisPanier($typeConso) {
        $panier = json_decode($_COOKIE["panier"] ?? "[]", true);
        
        $this->prepareAndFetchOne(
            "INSERT INTO commande(id_user, id_etat, date, total_commande, type_conso) VALUES (:idUser, :idEtat, SYSDATE(), 0, :typeConso)",
            [
                ":idUser" => $_SESSION["user"]["id_user"],
                ":idEtat" => 1,
                ":typeConso" => $typeConso
            ]
        );

        $idCommandeInseree = $this->dbh->lastInsertId();

        foreach($panier as $produit){
            $idProduit = $produit["id_produit"];
            $quantite = $produit["qty"];

            $this->prepareAndFetchOne(
                "INSERT INTO ligne(id_commande, id_produit, qte, total_ligne_ht) VALUES (:idCommande, :idProduit, :qte, :totalHt)",
                [
                    ":idCommande" => $idCommandeInseree,
                    ":idProduit" => $idProduit,
                    ":qte" => $quantite,
                    ":totalHt" => 0
                ]
            );
        }
    }
}