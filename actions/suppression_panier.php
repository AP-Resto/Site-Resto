<?php

include "../assets/functions/ConnexionBDD.php";
$bdd = new ConnexionBDD();

$panier = json_decode($_COOKIE["panier"] ?? "[]", true);

if (isset($_GET["idProduit"])) {
   $idProduit = intval($_GET["idProduit"]);
   
    foreach($panier as $key => $item){
        if($item["id_produit"] == $idProduit){
            unset($panier[$key]);
        }
    }
}

setcookie("panier", json_encode($panier), time() + 72000, "/");