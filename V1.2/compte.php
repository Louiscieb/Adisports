<?php
require_once('utilisateur.php');
session_start();
$Essais = isset($_SESSION['Essais']) ? $_SESSION['Essais'] : 0;

if (isset($_POST['username']) && isset($_POST['password'])) { #Required en gros
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (array_key_exists($username, $utilisateurs)) {
        $userInfo = $utilisateurs[$username]; #Utilisateur.php est un dico de tuple avec Username=>password plus code postal 
        if ($userInfo['password'] === $password) { #On est bon!
            $_SESSION['username'] = $username;
            $_SESSION['Essais'] = 0;
            header("Location: Accueil2.php"); #on a init la session on peut aller dans le vrai acceuil
            exit();
        } else { #erreur de mdp
            $_SESSION['Essais'] = ++$Essais;
            header("Location: connexion.php");
            exit();
        }
    } else { #le username n'existe pas 
        $_SESSION['Essais'] = ++$Essais;
        # alert() n'existe pas en PHP, on ne peut pas l'utiliser ici
        if ($Essais > 5) {
            unset($_SESSION['Essais']);
            header("Location: Creation.php");
            exit();
        } else {
            header("Location: connexion.php");
            exit();
        }
    }
} else {
    header("Location: Creation.php");
    exit();
}
?>
