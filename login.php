<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$messageerreur = "";
$inscriptionReussie = $_SESSION["inscriptionReussie"] ?? false;
unset($_SESSION["inscriptionReussie"]);
function my_autoloader($c)
{
    include "assets/functions/$c.php";
}
spl_autoload_register('my_autoloader');

$user = FALSE;

$db = new ConnexionBDD();

if (!empty($_POST["login"]) && !empty($_POST["mdp"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    $estConnecte = $db->login($login, $mdp);
    if ($estConnecte) {
        header("Location: commander.php");
    } else {
        $messageerreur = "Login ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/login.css" rel="stylesheet">
    <title>Ma Fée - Connexion à votre compte</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <img src="assets/images/log.png">
    <div class="conteneur">
        <h1>BIENVENUE !</h1>
        <h2>Connectez vous à votre compte <span class="hint">Ma fée</span>, et venez passer votre commande</h2>
        <?php
        if ($messageerreur != "") {
            echo("<h3 style='color: red; text-align: center'>$messageerreur</h3>");
        }

        if($inscriptionReussie == TRUE){
            echo("
            <p class=\"success-bande\">
                Inscription réussie !
            </p>
            ");
        }
        ?>
    
        <form action="" method="post">
            <p>login <br><input id="login" name="login" type="text" required></p>
            <p>Mot de passe <br><input id="mdp" name="mdp" type="password" required></p>
            <p class="text2"><a href="">Mot de passe oublié?</a></p>
            <p class="text"><input class="connexion" type="submit" value="CONNEXION !"></p>
        </form>
    </div>
</body>

</html>