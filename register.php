<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
</head>

<body>
    <img src="img/Logo_resto.png" alt="">
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