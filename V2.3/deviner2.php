<?php
session_start();

if (!isset($_POST["trouver"])) {
    echo "Champ vide";
    exit;
}
$tentative = trim($_POST["trouver"]);

$Sportifs = json_decode(file_get_contents("Mot2.json"), true);

$cles = array_keys($Sportifs);
$nomSportif = $cles[0]; 



if ($tentative == $nomSportif) {
    echo "Yes";
} else {
    echo "No";
}

exit;
