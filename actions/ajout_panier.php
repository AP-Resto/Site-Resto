<?php

include "../assets/functions/ConnexionBDD.php";
$bdd = new ConnexionBDD();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    die();
}
$panier = json_decode($_COOKIE["panier"] ?? "[]", true);

if (isset($_GET["idProduit"])) {
    $item = $bdd->prepareAndFetchOne(
        "SELECT * FROM produit WHERE produit.id_produit = :idProduit;",
        [
            ":idProduit" => intval($_GET["idProduit"])
        ]
    );
    if (empty($item)) {
        // Le produit n'existe pas.

        echo json_encode([
            "error" => "Produit non present."
        ], JSON_PRETTY_PRINT);
        return;
    }

    // Recherche dans le panier, si il y a déjà un item avec id_produit = idProduit, alors on ajoute 1 la quantité
    // Sinon, on ajoute l'item au panier avec 1 de quantité.
    
    $found = FALSE;
    foreach($panier as $key => $i){
        if($i["id_produit"] == $item["id_produit"]){
            $panier[$key]["qty"] = intval($panier[$key]["qty"]) + 1;
            $found = TRUE;
        }
    }

    if(!$found){
        $panier[] = [
            "id_produit" => $item["id_produit"],
            "qty" => 1
        ];
    }
}

setcookie("panier", json_encode($panier), time() + 72000, "/");