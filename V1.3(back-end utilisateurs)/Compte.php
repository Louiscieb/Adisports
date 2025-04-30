<?php
$username = $_POST['username'];
$password = $_POST['password'];

$decodage=file_get_contents('Utilisateurs.json');
$Fichier=json_decode($decodage,true);/*true j'ai pas trop compris*/
if (!is_array($Fichier)) {
    $Fichier = []; /* garde fou $fichier vide*/
}
foreach ($Fichier as $key => $value) {
    if ($key == $username) {
        echo "pseudo déjà pris";
        exit(); 
    }
}
$Fichier[$username]=$password;
file_put_contents("Utilisateurs.json",json_encode($Fichier));
/*mettre les droit d'ecriture a Utilisateur.json*/
/*pas besoin de gerer les virgules dans notres bdd car json est goatesque*/

