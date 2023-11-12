<?php
include "assets/functions/ConnexionBDD.php";
$connexion = new ConnexionBDD();
$messagesErreur = [];

$email = $_POST["email"] ?? NULL;
$email_confirmation = $_POST["email-confirmation"] ?? NULL;
$password = $_POST["password"] ?? NULL;
$password_confirmation = $_POST["password-confirmation"] ?? NULL;
$accept_conditions = $_POST["accept_conditions"] ?? NULL;

if (isset($_POST["submit"])) {
    if (
        $email == NULL
        || $email_confirmation == NULL
        || $password == NULL
        || $password_confirmation == NULL
        || $accept_conditions == NULL
    ) {
        $messagesErreur[] = "Vous devez remplir entièrement le formulaire !";
    }

    if ($password <= 8) {
        $messagesErreur[] = "Le mot de passe doit contenir au moins 8 caractères";
    }

    if ($accept_conditions == NULL) {
        $messagesErreur[] = "Vous devez accepter les conditions d'utilisations";
    }

    if ($email != $email_confirmation || $password != $password_confirmation) {
        $messagesErreur[] = "Les mots de passe ou les emails ne correspondent pas";
    }

    if (count($messagesErreur) == 0) {
        $estceQueMailEstDejaPris = $connexion->verificationSiMailDejaPris($email);

        if ($estceQueMailEstDejaPris) {
            $messagesErreur[] = "L'adresse email est déjà utilisée";
        } else {
            $resultat = $connexion->register($email, $password);
            if ($resultat == TRUE) {
                // On stocke une variable temporaire dans la session qu'on efface sur la page de login
                // et qui sert juste à dire "Inscription réussie en haut"
                $_SESSION["inscriptionReussie"] = TRUE;
                
                // Enregistrement réussi, on passe à la page de login pour lui demander de se connecter.
                header("Location: login.php");
            } else {
                $messagesErreur[] = "Une erreur est survenue durant l'inscription...";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

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
            if (count($messagesErreur) > 0) {
                echo "<ul>";
                foreach ($messagesErreur as $messageErreur) {
                    echo "<li>$messageErreur</li>";
                }
                echo "</ul>";
            }
            ?>
        </p>
        <p class="separator"></p>

        <label> Adresse e-mail </label>
        <input type="email" name="email" required>
        
        <label> Confirmation de l'adresse email</label>
        <input type="email" name="email-confirmation" required>
        
        <p class="separator"></p>
        
        <label> Mot de passe</label>
        <input type="password" name="password" required>
        
        <label> Confirmation du mot de passe</label>
        <input type="password" name="password-confirmation" required>
        
        <a href="login.php" class="sublink">Vous avez déjà un compte ?</a>
        
        <p class="separator"></p>

        <label>
            <input type="checkbox" name="accept_conditions" required> J'accepte les conditions d'utilisation
        </label>
            <input type="submit" name="submit" value="Inscription">
    </form>

</body>

</html>