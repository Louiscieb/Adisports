<?php
session_start();

$username = $_SESSION['username'];
$serveur = $_POST['nom'];
$password_s = $_POST['mdp'];

if (!file_exists('./serveur.json')) {
    echo "fichier_error";
    exit();
}

$decodage = file_get_contents('./serveur.json');
$Fichier = json_decode($decodage, true);

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['serv'])) {
        echo "conect_creat";
        exit();
    } else {
        if (isset($Fichier[$serveur]) && empty($Fichier[$serveur]["mdp"])) {
            
            if (count($Fichier[$serveur]["joueurs"]) === 0) {
                $Fichier[$serveur]["mdp"] = $password_s;
                $Fichier[$serveur]["host"] = $username;
                $Fichier[$serveur]["joueurs"][] = $username;
                $Fichier[$serveur]["launch"] = false;                
                $_SESSION['serv'] = $serveur;
                file_put_contents("serveur.json", json_encode($Fichier));
                echo $username . "," . $serveur . "," . count($Fichier[$serveur]["joueurs"]);
                exit();
            } else {
                echo "serv_already";
                exit();
            }
        } else {
            echo "serv_already";
            exit();
        }
    }
} else {
    echo "intru";
    exit();
}
