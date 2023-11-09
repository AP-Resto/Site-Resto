<?php
include "assets/functions/ConnexionBDD.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$connexionBDD = new ConnexionBDD();
$messageErreur = "";

$panier = json_decode($_COOKIE["panier"] ?? "[]", true);
$totalCommande = $connexionBDD->calculerTotalPanier($panier);

if (isset($_POST["submit"])) {
    $carte = $_POST["carte_bancaire"];
    $date =  $_POST["date_exp"];
    $cryptogramme = $_POST["cryptogramme"];
    $nom = $_POST["nom_titulaire"];
    
    if (mb_strlen($cryptogramme) != 3) {
        $messageErreur = "Le cryptogramme doit faire 3 caractères de long.";
    }

    if (mb_strlen($carte) != 16) {
        $messageErreur = "Le numéro de la carte doit faire 16 caractères de long.";
    }

    if(mb_strlen($nom) < 3) {
        $messageErreur = "Le nom doit faire plus de 3 caractères de longueur";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payer</title>
    <link rel="stylesheet" href="assets/css/payer.css">
</head>

<body>
<img src="assets/images/log.png" alt="">
<form action="" method="POST" class="form_payer">
    <h2>Payer</h2>
    <p>Commande d'un montant de <b>
          <span style="color: #00A45B;"> <?= number_format($totalCommande, 2) . "€" ?></span> 
        </b>
    </p>
    <?php
    if ($messageErreur != "") {
        echo "<p class=\"erreur\">$messageErreur</p>";
    }
    ?>
    <p class="separator"></p>
        <label> Nom du titulaire</label>
        <input type="text" name="nom_titulaire">
        <label> N° Carte </label>
        <input type="text" id="carte_bancaire" name="carte_bancaire">
        <label> Date d'expiration</label>
        <input type="date" name="date_exp">
        <label> Cryptogramme (CVC)</label>  
        <input type="text" name="cryptogramme">
    <p class="separator"></p>

    <input type="submit" name="submit" value="Payer">
    </form>
    <a href="commander.php">Modifier la commande</a>

    <script src="assets/js/payer.js"></script>

</body>

</html>