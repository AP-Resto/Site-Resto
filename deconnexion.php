<?php
session_start();

function deconnexion()
{
    session_unset();
    session_destroy();
    setcookie('email', '', time() - 3600);
    setcookie('mdp', '', time() - 3600);
    header('Location: index.php');
}

deconnexion();
