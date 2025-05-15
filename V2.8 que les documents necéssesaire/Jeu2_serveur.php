<?php
session_start();


if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 10;
}

$data = json_decode(file_get_contents("Mot2.json"), true);

if (!$data || !is_array($data)) {
    die("Erreur : Mot.json invalide ou vide.");
}

$cleSportif = array_key_first($data);
$Sportif = $data[$cleSportif];

if (!isset($Sportif["prenom"])) {
    die("Erreur : données du sportif incomplètes.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = $_POST["indice"] ?? "";

    switch ($indice) {
        case 'prenom':
            if ($_SESSION["points"] >= 6) {
                $_SESSION["points"] -= 6;
                echo $_SESSION["points"] . "," . $Sportif["prenom"];
            } else {
                echo $_SESSION["points"] . "," . "fonds insuffisant";
            }
            break;

        case 'club':
            if ($_SESSION["points"] >= 5) {
                $_SESSION["points"] -= 5;
                echo $_SESSION["points"] . "," . $Sportif["club"];
            } else {
                echo $_SESSION["points"] . "," . "fonds insuffisant";
            }
            break;

        case 'date_debut':
            if ($_SESSION["points"] >= 2) {
                $_SESSION["points"] -= 2;
                echo $_SESSION["points"] . "," . $Sportif["Date_debut"];
            } else {
                echo $_SESSION["points"] . "," . "fonds insuffisant";
            }
            break;

        case 'date_fin':
            if ($_SESSION["points"] >= 3) {
                $_SESSION["points"] -= 3;
                echo $_SESSION["points"] . "," . $Sportif["Date_fin"];
            } else {
                echo $_SESSION["points"] . "," . "fonds insuffisant";
            }
            break;

        case 'sport':
            if ($_SESSION["points"] >= 3) {
                $_SESSION["points"] -= 3;
                echo $_SESSION["points"] . "," . $Sportif["sport"];
            } else {
                echo $_SESSION["points"] . "," . "fonds insuffisant";
            }
            break;

        default:
            echo $_SESSION["points"] . "," . "#Indice_invalide";
            break;
    }
}
?>
