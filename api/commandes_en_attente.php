<?php
include "../assets/functions/ConnexionBDD.php";
include "../assets/functions/ReponseJson.php";

$connexionBdd = new ConnexionBDD();

$commandes = $connexionBdd->prepareAndFetchAll(
    "SELECT * FROM commande WHERE commande.id_etat = 1;"
);

header("Content-Type: application/json");
ReponseJson::repondre([
    "success" => true,
    "nbCommandes" => count($commandes),
    "commandes" => $commandes
]);