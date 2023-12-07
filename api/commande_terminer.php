<?php
include "../assets/functions/ConnexionBDD.php";
include("../assets/functions/ReponseJson.php");
$connexionBdd = new ConnexionBDD();

if (!isset($_GET["id_commande"])) {
    ReponseJson::repondre([
        "succes" => false,
        "erreur" => "Vous devez fournir un id de commande avec le parametre URL ?id_commande=XX"
    ]);
}

$commande = $_GET["id_commande"];
if ($connexionBdd->prepareAndFetchOne("SELECT * FROM commande WHERE id_commande = :id_commande", [":id_commande" => $commande])) {
    ReponseJson::repondre([
        "succes" => false,
        "erreur" => "La commande $commande est inexistante"
    ]);
}

$commandes = $connexionBdd->prepareAndFetchOne(
    "UPDATE commande SET id_etat = 2 where id_commande = :id_commande",
    [
        ":id_commande" => $commande
    ]
);

ReponseJson::repondre([
    "succes" => true,
    "message" => "La commande $commande est terminer"
]);