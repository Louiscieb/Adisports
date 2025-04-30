<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="connexion.css">
    <title>Nouveau compte</title>
</head>
<body>
    <div class="entete">
    <div class="titre"><h1>Adisport</h1>
    <h4>Devine les tous!</h4>
    </div>
<a class="connexion"href="./connexion.php" class="login">Se connecter</a>
</div>
<br>
<div class="A">

    <div class="B">
        <div class="C">
            Créer un compte
        </div>

        <form id="creat_form">
            <label for="nom">Pseudo:</label><br>
            <input type="text" id="nom" name="username" autocomplete="off" required placeholder="Pseudo"><br> 
            <label for="mdp">Mot de passe:</label><br>
            <input type="password" id="mdp" name="password" required placeholder="Mot de passe">
            <br>
            <input type="submit" value="Créer un compte" class="bouton">
        </form>
    </div>
</div>
<br>
</body>
</html>
<script src="app2.js"></script>