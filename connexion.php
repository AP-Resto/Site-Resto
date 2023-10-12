<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
$messageerreur = "";
function my_autoloader($ConnexionBDD) {
    include 'assets/functions/'.$ConnexionBDD.'.php';
}
spl_autoload_register('my_autoloader');

$user = FALSE;

$db = new ConnexionBDD();

if (!empty($_POST["email"]) && !empty($_POST["mdp"])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    $estConnecte = $db->login($email,$mdp);
    if($estConnecte){
    header("location : menus.php");
    }else{
        $messageerreur = "Email ou mot de passe incorrect";
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <img src="assets/images/log.png">
    <div class="conteneur">
        <h1>BIENVENUE !</h1>
        <h2>Connectez vous à votre compte <span class="hint">Ma fée</span>, et venez passer votre commande</h2>
        <?php
        if ($messageerreur != ""){
            echo "<h3 style='color: red; text-align: center'> ".$messageerreur. "</h3>";
        }
        ?>

    <form action="" method="post">
        <p>Adresse email <br><input id="email" name="email" type="text"></p>
        <p>Mot de passe <br><input id="mdp" name="mdp" type="password"></p>
        <p class="text2"><a href="">Mot de passe oublié?</a></p>
        <p class="text"><input class="connexion" type="submit" value="CONNEXION !"></p>
    </form>
</div>
</body>
</html>