<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=cinzia">
    <link rel="stylesheet" href="connexion.css">
    <title>Nouveau compte</title>
</head>
<body>
    
<div class="A">
    <div class="B">
        <div class="C">
            Créer un compte
        </div>
        <form action="new_compte.php" method="post" style="float: left;margin-top: 5px;">
            <label for="nom">Pseudo:</label><br>
            <input type="text" id="nom" name="username" required placeholder="Pseudo"><br> 
            <label for="mdp">Mot de passe:</label><br>
            <input type="password" id="mdp" name="password" required placeholder="Mot de passe"><br>
            </select><br><br> 
            <input type="submit" value="Creation" class="bouton">

        </form>
    </div>
    <br>
    <img src="Unesco.jpg" alt="Unescp"class="dos">
</div>

</body>
</html>