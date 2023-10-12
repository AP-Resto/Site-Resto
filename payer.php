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
    <p>Commande n°XXXX pour un montant de XX,XX €</p>
    <p class="separator"></p>
    <form action="">
        <label> N° Carte </label>
        <input type="carte" name="carte"> <br>
        <label> Date d'expiration</label>
        <input type="date" name="email-confirmation"> <br>
        <label> Cryptogramme (CVC)</label>
        <input type="Cryptogramme" name="Cryptogramme"> <br>
        <button class="favorite styled" type="button">Payer</button>
    </form>

    <p class="separator"></p>
    <a href="commander.php">Modifier la commande</a>
    <a href="commander.php">Annuler</a>
</body>

</html>