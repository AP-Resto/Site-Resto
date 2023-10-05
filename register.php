<?php
include "assets/functions/ConnexionBDD.php";
$connexion = new ConnexionBDD();
$messageErreur = "";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $email_confirmation = $_POST["email-confirmation"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password-confirmation"];
    $accept_conditions = $_POST["accept_conditions"];

    if ($password <= 8) {
        $messageErreur = "Le mot de passe doit contenir au moins 8 caractères";
    }

    if ($email == $email_confirmation && $password == $password_confirmation && $accept_conditions == "on") {
        $resultat = $connexion->register($email, $password);
        if ($resultat == TRUE) {
            header("Location: login.php");
        } else {
            $messageErreur = "Erreur lors de l'inscription";
        }
    } else {
        $messageErreur = "Les mots de passe ou les emails ne correspondent pas";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
    <img src="assets/images/log.png" alt="">
    <form action="" method="POST" class="form_connexion_inscription">
        <h2>Enregistrement</h2>
        <p class="welcome">
            Remplissez les champs ci-dessous pour créer votre compte <span style="color: #00A45B;">Ma Fée </span> !
        </p>
        <p>
            <?php
            if ($messageErreur != "") {
                echo "<p class=\"erreur\">$messageErreur</p>";
            }
            ?>
        </p>
        <p class="separator"></p>
        <label> Adresse e-mail </label>
        <input type="email" name="email">
        <label> Confirmation de l'adresse email</label>
        <input type="email" name="email-confirmation">
        <p class="separator"></p>
        <label> Mot de passe</label>
        <input type="password" name="password">
        <label> Confirmation du mot de passe</label>
        <input type="password" name="password-confirmation">
        <a href="login.php" class="sublink">Vous avez déjà un compte ?</a>
        <p class="separator"></p>

        <label>
            <input type="checkbox" name="accept_conditions"> J'accepte les conditions d'utilisation
        </label>
        <input type="submit" name="submit" value="Inscription">
    </form>

</body>

</html>