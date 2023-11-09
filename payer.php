<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function autoloader($className)
{
    include "assets/functions/$className.php";
}
spl_autoload_register("autoloader");

$connexionBDD = new ConnexionBDD();
$panier = json_decode($_COOKIE["panier"] ?? "[]", true);
$totalCommande = $connexionBDD->calculerTotalPanier($panier);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/payer.css">
    <title>Payer</title>
</head>

<body>
    <h1>Payer</h1><br>
    <p>Commande d'un montant de <b>
            <?= number_format($totalCommande, 2) . "€" ?>
        </b>
    </p>
    <p class="separator"></p>
    <form action="">
        <label> N° Carte </label>
        <input type="carte" name="carte"> <br>
        <label> Date d'expiration</label>
        <input type="date" name="email-confirmation"> <br>
        <label> Cryptogramme (CVC)</label>
        <input type="Cryptogramme" name="Cryptogramme"> <br>
        <input type="submit" value="Payer !">
    </form>

    <p class="separator"></p>
    <a href="commander.php">Modifier la commande</a>
    <a href="commander.php">Annuler</a>
</body>

</html>