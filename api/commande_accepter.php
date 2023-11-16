<?php 
include("../assets/functions/ConnexionBDD.php");
$connexionBdd = new ConnexionBDD();

// Pour firefox on précice que le formattage est en format json
header("Content-Type: application/json");

// On vérifie si l'ID de commande existe dans la base 
$ID_commande = $_GET["id_commande"];
if(!($connexionBdd->prepareAndFetchOne("SELECT * FROM commande WHERE id_commande = :idCommande", [":idCommande" => $ID_commande]))){
    $json = [
        "success" => false,
        "erreur" => "La commande $ID_commande est inexistante !"
    ];

    echo json_encode($json);
    die();
}

// Si l'ID de commande est manquant, le script renvoie une réponse JSON indiquant l'erreur, puis le script se termine.
if(!isset($_GET["id_commande"])){
    $json = [
        "success" => false,
        "erreur" => "Vous devez fournir un id de commande avec le parametre URL ?id_commande=XX"
    ];

    echo json_encode($json);
    die();
}
// On update l'état de l'id commande on le met à 1 ce qui représente l'état "en préparation"
$commandes = $connexionBdd->prepareAndFetchOne(
    "UPDATE commande SET id_etat = :idEtat WHERE id_commande = :idCommande;",
    [
        ":idEtat" => 1,
        ":idCommande" => $ID_commande 
    ]
);

//Après la mise à jour réussie, le script renvoie une réponse JSON indiquant le succès de l'opération.
$json = [
    "success" => true,
    "message" => "La commande $ID_commande est maintenant acceptee !"
];
echo json_encode($json);
