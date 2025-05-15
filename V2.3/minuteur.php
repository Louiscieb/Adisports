<?php
session_start();

$DUREE_BOMBE = 600; // 10 minutes

// Si appel POST, raccourcir le minuteur (ex : pénalité)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Réduit de 120 secondes (2 minutes)
    if (isset($_SESSION['explosion_time'])) {
        $_SESSION['explosion_time'] -= 120;
    }
}

// Initialisation de la bombe si pas encore lancée
if (!isset($_SESSION['explosion_time'])) {
    $_SESSION['explosion_time'] = time() + $DUREE_BOMBE;
}

$restant = $_SESSION['explosion_time'] - time();

if ($restant <= 0) {
    echo "Boom";
} else if ($restant % 60 <= 1) { // petit delta pour laisser passer l'affichage toutes les minutes
    echo "0"; 
} else {
    echo ""; // pas d'affichage si rien à signaler
}
exit;
