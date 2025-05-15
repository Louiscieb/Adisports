<?php
session_start(); // Assure-toi que la session est démarrée

// Vérifie si la session contient un serveur
if (!isset($_SESSION["serv"])) {
    echo "Aucun serveur dans la session.";
    exit();
}

$serv = $_SESSION["serv"]; 


if (file_exists("serveur.json")) {
    $decodage = file_get_contents("serveur.json");
    $serveurData = json_decode($decodage, true);
} else {

    $serveurData = [];
}


$serveurData[$serv] = [
    "mdp" => null,
    "host" => null,
    "joueurs" => [],
    "launch" => false
];


$json = json_encode($serveurData);


file_put_contents("serveur.json", $json);

header("Location: Page.php");
exit();
