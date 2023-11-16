<?php
include "../assets/functions/ConnexionBDD.php";
$connexionBdd = new ConnexionBDD();

if(!isset($_GET["id_commande"])){
    $json = [
        "succes" => false,
        "erreur" => "Vous devez fournir un id de commande avec le parametre URL ?id_commande=XX"
    ];

    echo json_encode($json);
    die();
}

$commande = $_GET["id_commande"];

if($connexionBdd->prepareAndFetchOne("SELECT * FROM commande WHERE id_commande = :id_commande", [":id_commande" => $commande]))
{
    $json = [
        "succes" => false,
        "erreur" => "La commande $commande est inexistante"
];
    echo json_encode($json);
    die();
}

$commandes = $connexionBdd->prepareAndFetchOne(
    "UPDATE commande SET id_etat = 2 where id_commande = :id_commande",
    [
        ":id_commande" => $commande
    ]
);

$json = [
    "succes" => true,
    "message" => "La commande $commande est terminer"
];
echo json_encode($json);
die();