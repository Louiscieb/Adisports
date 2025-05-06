<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "intru";
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


if (isset($_SESSION['serv'])) {
    echo "attente";
    exit();
}


if (!isset($Fichier[$serveur]) || $Fichier[$serveur]["mdp"] !== $password_s) {
    echo "invalide";
    exit();
}
$joueurs = $Fichier[$serveur]["joueurs"];
$nb_joueurs = count($joueurs);

if ($nb_joueurs >= 6) {
    echo "plein";
    exit();
}

for ($i = 0; $i <$nb_joueurs-1; $i++) {
    if($joueurs[$i]==$username){
        echo"attente";
        exit();
    }
}

if (in_array($username, $joueurs)) { /*soucis ici*/
    echo "attente";
    exit();
}


$Fichier[$serveur]["joueurs"][] = $username; /* ajoute a la fin*/
$_SESSION['serv'] = $serveur;


file_put_contents("./serveur.json", json_encode($Fichier));

if (count($Fichier[$serveur]["joueurs"]) === 6) {
    echo "launch";
    exit();
}

echo $username . "," . $serveur . "," . count($Fichier[$serveur]["joueurs"]); 
exit();
?>
