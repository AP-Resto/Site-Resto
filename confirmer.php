<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    die();
}
$messageerreur = "";
function my_autoloader($ConnexionBDD)
{
    include 'assets/functions/' . $ConnexionBDD . '.php';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Confirmation de votre commande</title>
</head>

<body>

    <h1>Confirmation de commande</h1>

    <p>Merci pour votre commande !</p>
    <p>Votre paiement a été effectué avec succès.</p>
    <p>Votre commande est en cours de préparation.</p>
    <p>Vous serez notifié par e-mail lorsque votre commande sera prête.</p>
    <p>Merci <i class="fa-regular fa-thumbs-up"></i></p>

    <a href="commander.php">Revenir à la page d'accueil</a>

</body>

</html>