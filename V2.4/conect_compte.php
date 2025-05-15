<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$decodage = file_get_contents('Utilisateurs.json');
$Fichier = json_decode($decodage, true); 

if (!is_array($Fichier)) {
    echo "fichier_error";
    exit();
}

if (isset($Fichier[$username])) {
    if ($Fichier[$username] === $password) {
        $_SESSION['username'] = $username;
        echo "success";
        exit();
    } else {
        echo "Mot de passe incorrect";
        exit();
    }
} else {
    echo "Nom d'utilisateur inconnu";
    exit();
}
