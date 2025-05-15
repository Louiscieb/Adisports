<?php
session_start();

if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 10;
 
    
}

$mot_chemin ="Mot2.json";

$Sportif =json_decode(file_get_contents($mot_chemin), true);
$Sportif=$Sportif["1"];/* pourquoi mettre un clée primaire si on a qu'on sportif ?? afin de pouvoir faire une liste de sportif et que l'admin ne soit pas obligé de tout remettre a chaques fois cependant nous n'avons pas le temps pour integrer cette fonctionalité*/

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION["mot"]) ){
    $indice=$_POST["indice"];
    switch ($indice) {
        case 'prenom':
            if ($_SESSION["points"] >= 6) {
                $_SESSION["points"] -= 6;
                echo $_SESSION["points"] . "," . $Sportif["prenom"];
            } else {
                echo "-1,fonds insuffisant";
            }
            break;
    
        case 'club':
            if ($_SESSION["points"] >= 5) {
                $_SESSION["points"] -= 5;
                echo $_SESSION["points"] . "," . $Sportif["club"];
            } else {
                echo "-1,fonds insuffisant";
            }
            break;
    
        case 'date_debut':
            if ($_SESSION["points"] >= 2) {
                $_SESSION["points"] -= 2;
                echo $_SESSION["points"] . "," . $Sportif["Date_debut"];
            } else {
                echo "-1,fonds insuffisant";
            }
            break;
    
        case 'date_fin':
            if ($_SESSION["points"] >= 3) {
                $_SESSION["points"] -= 3;
                echo $_SESSION["points"] . "," . $Sportif["Date_fin"];
            } else {
                echo "-1,fonds insuffisant";
            }
            break;
    
        case 'sport':
            if ($_SESSION["points"] >= 3) {
                $_SESSION["points"] -= 3;
                echo $_SESSION["points"] . "," . $Sportif["sport"];
            } else {
                echo "-1,fonds insuffisant";
            }
            break;
    
        default:
            echo "#Error_indice";
            break;
    }
    
}
    exit;
    
