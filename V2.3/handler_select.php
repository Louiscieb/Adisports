<?php
session_start();

$Nom = $_POST['Nom'] ?? null;
$prenom = $_POST['prenom'] ?? null;
$club = $_POST['club'] ?? null;
$date_debut = $_POST['date_debut'] ?? null;
$sport = $_POST['sport'] ?? null;
$date_fin = $_POST['date_fin'] ?? null;




$decodage = file_get_contents('Mot.json');
$Fichier = json_decode($decodage, true); 

if (!is_array($Fichier)) {
    $Fichier = [];
}
$Fichier = [
    $Nom => [
        "prenom" => $prenom,
        "Date_debut" => $date_debut,
        "Date_fin" => $date_fin,
        "club" => $club,
        "sport" => $sport
    ]
];
$_SESSION["mot"]=$Nom;
file_put_contents('./Mot.json', json_encode($Fichier));
echo "good";
?>