<?php
session_start();

$DUREE_BOMBE = 600; // 10 minutes

if (!isset($_SESSION['explosion_time'])) {
    $_SESSION['explosion_time'] = time() + $DUREE_BOMBE;
}

$restant = $_SESSION['explosion_time'] - time();

if ($restant <= 0) {
    echo "Boom"; 
} else {
    echo "0"; 
}