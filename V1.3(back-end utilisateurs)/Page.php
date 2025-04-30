<?php session_start();
$_SESSION["Username"] = "Louis"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="coucou.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <script src="Acceuil.js" ></script>
    <title>Adisport</title>
</head>
<body>
    <div class="entete">
    <div class="titre"><h1>Adisport</h1>
    <h4>Devine les tous!</h4></div>
    <div class="photo_prof">
          <img id="photo_p" src="Images/profil1.png" alt="Photo de profil" >
          <?php echo $_SESSION["Username"] ?>
      </div>
      
    </div>
    <div class="corp">
        <div class="connexion">
        <h2>Connectez vous avec vos amis:</h2>
        <form action="Jeu.html" method="GET">
            <label for="usr">Nom Serveur</label>
            <input id="usr" type="text" name="nom" required>
        <br>
            <label for="mdp">Mot de passe</label>
            <input id="mdp" type="password" name="mdp" required>
        
            <button type="submit">Jouer</button>
        </form>
        </div>


</div>
</div>
    <div class="bottom">Snail enjoyer & co</div>
</body>
</html>