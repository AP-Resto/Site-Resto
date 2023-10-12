<?php
function autoloader($className)
{
    include "assets/functions/$className.php";
}
spl_autoload_register("autoloader");

$connexionBDD = new ConnexionBDD();
$plats = $connexionBDD->prepareAndFetchAll(
    "SELECT * FROM produit"
);


$panier = json_decode($_COOKIE["panier"] ?? "[]", true);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Fée - Restaurant de mafé</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="assets/images/log.png" class="logo">
    </header>
    <aside id="profile">
        <div class="head">
            <div class="left">
                Mon profil
            </div>
            <div class="right">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
        </div>

        <div class="controls">
            <a href="deconnexion.php" class="logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Déconnexion
            </a>
        </div>
    </aside>
    <aside id="cart">
        <div class="head">
            <p class="title">Panier</p>
        </div>
        <div class="content">
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>
            <div class="item">
                <input type="number" value="1">
                <p class="name">Cheeseburger sur son lit de mayonnaise</p>
                <p class="price">0.00€</p>
            </div>

        </div>
        <div class="bottom">
            <button>Payer !</button>
        </div>
    </aside>


    <div class="container">
        <?php
        $i = 0;

        foreach ($plats as $plat) {
            $i++; // C'est juste le compteur pour avoir une image pour les plats depuis un autre site.

            $id = $plat["id_produit"];
            $libelle = $plat["libelle"];
            $prix = $plat["prix_ht"];
            echo "
                <div class=\"item\" data-item-id=\"$id\">
                <img src=\"https://generatorfun.com/code/uploads/Random-Food-image-$i.jpg\" class=\"preview\">
                <div class=\"content\">
                        <p class=\"name\">$libelle</p>
                        <p class=\"description\"></p>

                        <p class=\"bottom\">
                            <button class=\"ajoutPanier\">
                            <i class=\"fa-solid fa-cart-shopping\"></i>
                            <span>
                                Ajout au panier <span class=\"price\">" . number_format($prix, 2) . "</span> 
                            </span>                        
                            </button>
                        </p>
                    </div>
                </div>
            ";
        }
        ?>
    </div>

    <script src="assets/js/profileModule.js"></script>
</body>

</html>