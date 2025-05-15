<?php
session_start();

$chemin = "chatbox_user.json";
/*server contient pas mal d'info sur le serveur dont la methode utilisé d'envoi*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') { /*envoi*/
    if (!isset($_POST["message"]) || empty(trim($_POST["message"]))) {
        echo "#Error_";
        exit;
    }

    $username = $_SESSION["username"] ?? "Anonyme";
    $messageText = htmlspecialchars($_POST["message"]);
    $messages =json_decode(file_get_contents($chemin), true);
    $messages[] = ["username" => $username, "message" => $messageText];

    file_put_contents($chemin, json_encode($messages));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') { /*reccuperation*/
    if (!file_exists($chemin)) {
        echo json_encode([]);
        exit;
    }
    $messages = json_decode(file_get_contents($chemin), true);
    echo json_encode($messages);
    exit;
}

/* on n'est pas sensé arrivé la */
echo "#Error_";
exit;

?>
