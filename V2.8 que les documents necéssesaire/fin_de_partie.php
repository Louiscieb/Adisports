<?php
session_start();

if (!isset($_SESSION["serv"])) {
    http_response_code(400);
    echo "Aucun serveur dans la session.";
    exit();
}

$serv = $_SESSION["serv"];

$serveurData = [];
if (file_exists("serveur.json")) {
    $jsonData = file_get_contents("serveur.json");
    $serveurData = json_decode($jsonData, true);
}

$serveurData[$serv] = [
    "mdp" => null,
    "host" => null,
    "joueurs" => [],
    "launch" => false
];

file_put_contents("serveur.json", json_encode($serveurData));

echo "ok";
exit;
