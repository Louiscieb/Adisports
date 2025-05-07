<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "intru";
    exit();
}
if (isset($_SESSION['serv'])) {
    echo "attente";
    exit();
}

$username = $_SESSION['username'];
$serveur = $_POST['nom'];
$password_s = $_POST['mdp'];

if (!file_exists('./serveur.json')) {
    echo "fichier_error";
    exit();
}

$decodage = file_get_contents('./serveur.json');
$Fichier = json_decode($decodage, true);


/* Taille max du serveur = 6 */
/*echo= permet de  traiter en js*/



if (!isset($Fichier[$serveur]) || $Fichier[$serveur]["mdp"] !== $password_s) {
    echo "invalide";
    exit();
}
$joueurs = $Fichier[$serveur]["joueurs"];
$nb_joueurs = count($joueurs);


for ($i = 0; $i <$nb_joueurs; $i++) {
    if($joueurs[$i]==$username){
        echo"attente";
        exit();
    }
}


$Fichier[$serveur]["joueurs"][] = $username; /* ajoute a la fin*/
$_SESSION['serv'] = $serveur;


file_put_contents("./serveur.json", json_encode($Fichier));

if (count($Fichier[$serveur]["joueurs"]) === 6) {
    $Fichier[$serveur]["launch"] = true;
    file_put_contents("./serveur.json", json_encode($Fichier));
    echo "launch";
    exit();
}


echo $username . "," . $serveur . "," . count($Fichier[$serveur]["joueurs"]); 
exit();
?>
