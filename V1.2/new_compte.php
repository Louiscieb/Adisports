<?php
require_once('utilisateur.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['choix'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($utilisateur[$username])) {
        echo "Nom d'utilisateur déjà utilisé.";
        exit();
    }
    else{
    $utilisateurs[$username] = ['password' => $password];

    
    file_put_contents(
        'utilisateur.php',
        '<?php $utilisateurs = ' . var_export($utilisateur, true) . ';',FILE_APPEND
    );

    header("Location: connexion.php");
    exit();
}
}
?>
