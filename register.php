<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier si l'adresse e-mail et le mot de passe sont valides
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        // Les données sont valides, vous pouvez les stocker dans une base de données ou effectuer d'autres actions nécessaires.

        // Rediriger l'utilisateur vers une page de confirmation ou de connexion
        header("Location: login.php");
        exit();
    } else {
        // Les données ne sont pas valides, afficher un message d'erreur
        $error_message = "Veuillez saisir une adresse e-mail valide et un mot de passe d'au moins 6 caractères.";
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
    <form action="" class="form_connexion_inscription">
        <h2>Enregistrement</h2>
        <p class="welcome">
            Remplissez les champs ci-dessous pour créer votre compte <span style="color: #00A45B;">Ma Fée </span> !
        </p>
        <p class="separator"></p>
        <label> Adresse e-mail </label>
        <input type="email" name="email">
        <label> Confirmation de l'adresse email</label>
        <input type="email" name="email">
        <p class="separator"></p>
        <label> Mot de passe</label>
        <input type="password" name="password">
        <label> Confirmation du mot de passe</label>
        <input type="password" name="password">
        <a href="login.php" class="sublink">Vous avez déjà un compte ?</a>
        <p class="separator"></p>

        <label>
            <input type="checkbox" name="accept_conditions"> J'accepte les conditions d'utilisation
        </label>
        <input type="submit" value="Inscription">
    </form>

</body>

</html>