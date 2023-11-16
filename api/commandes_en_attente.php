<?php
include "../assets/functions/ConnexionBDD.php";
$connexionBdd = new ConnexionBDD();

$commandes = $connexionBdd->prepareAndFetchAll(
    "SELECT * FROM commande WHERE commande.id_etat = 1;"
);

header("Content-Type: application/json");
echo json_encode([
    "success" => true,
    "nbCommandes" => count($commandes),
    "commandes" => $commandes
]);