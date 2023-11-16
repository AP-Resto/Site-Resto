<?php 
include("../assets/functions/ConnexionBDD.php");
$connexionBdd = new ConnexionBDD();

// Pour firefox et le formattage
header("Content-Type: application/json");

if(!isset($_GET["id_commande"])){
    $json = [
        "success" => false,
        "erreur" => "Vous devez fournir un id de commande avec le parametre URL ?id_commande=XX"
    ];

    echo json_encode($json);
    die();
}

$ID_commande = $_GET["id_commande"];
if(!($connexionBdd->prepareAndFetchOne("SELECT * FROM commande WHERE id_commande = :idCommande", [":idCommande" => $ID_commande]))){
    $json = [
        "success" => false,
        "erreur" => "La commande $ID_commande est inexistante !"
    ];

    echo json_encode($json);
    die();
}

$commandes = $connexionBdd->prepareAndFetchOne(
    "UPDATE commande SET id_etat = :idEtat WHERE id_commande = :idCommande;",
    [
        ":idEtat" => 1,
        ":idCommande" => $ID_commande 
    ]
);

$json = [
    "success" => true,
    "message" => "La commande $ID_commande est maintenant acceptee !"
];
echo json_encode($json);
